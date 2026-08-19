<?php
namespace App\Http\Controllers;

use App\Mail\SendContactMailToAdmin;
use App\Mail\SendContactMailToUser;
use App\Models\Contact;
use App\Models\Industry;
use App\Models\PortfolioProject;
use App\Models\Tabing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $categories = collect(); // kept only because the commented-out services block still references $categories
        $industries = Industry::orderBy('title')->get();
        $tabings    = collect(); // kept for the same reason — portfolio projects have no tabing relation

        $projects = PortfolioProject::whereNull('deleted_at')
            ->where('status', 1)
            ->when($request->filled('industry') && $request->industry !== 'all', function ($query) use ($request) {
                $query->whereRaw('FIND_IN_SET(?, industry_ids)', [$request->industry]);
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'projects'   => $projects,
                'industries' => $industries,
                'tabings'    => $tabings,
            ]);
        }

        return view('front.dashboard', compact('categories', 'industries', 'projects', 'tabings'));
    }

    protected function getActiveTabings()
    {
        if (! Schema::hasTable('tabings')) {
            return collect();
        }

        return Tabing::where('status', 1)
            ->orderBy('name')
            ->get(['id', 'category_id', 'name']);
    }

    public function projectDetail($projectUrl)
    {
        $project = PortfolioProject::with('media')
            ->where('url', $projectUrl)
            ->whereNull('deleted_at')
            ->firstOrFail();

        $industryNames = Industry::whereIn('id', $project->industry_ids_array)
            ->pluck('title');

        $servicesList = $project->services_array;

        // Group media by media_group so files uploaded together stay together,
        // preserving upload order via sort_order
        $galleryGroups = $project->media
            ->sortBy('sort_order')
            ->groupBy('media_group')
            ->values(); // re-index 0,1,2... so we can treat position 0 as "first", 1 as "second", etc.

        $nextProject = PortfolioProject::where('id', '!=', $project->id)
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->inRandomOrder()
            ->first();

        return view('front.projectdetail', compact('project', 'industryNames', 'servicesList', 'galleryGroups', 'nextProject'));
    }

    public function contact()
    {
        $metatitle       = "";
        $metadescription = "";

        return view('front.contact', compact('metatitle', 'metadescription'));
    }

    public function contactstore(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'company_name'          => 'required|string|max:255',
            'email'                 => 'required|email',
            'number'                => 'required|string|max:20',
            'interested_in'         => 'required|string|min:3',
            'venture_or_growth'     => 'required|string',
            'timeline'              => 'required|string',
            'budget'                => 'required|string',
            'project_description'   => 'nullable|string',
            'extra_details'         => 'nullable|string',
            'other_service_details' => 'nullable|string',
        ]);

        // "Other" check
        $interestedIn = $request->input('interested_in', '');
        if (str_contains($interestedIn, 'Other') && empty(trim($request->other_service_details))) {
            return back()
                ->withErrors(['other_service_details' => 'Please specify the other service details when "Other" is selected.'])
                ->withInput();
        }

        $contact                        = new Contact();
        $contact->name                  = $request->name;
        $contact->company_name          = $request->company_name;
        $contact->email                 = $request->email;
        $contact->number                = $request->number;
        $contact->interested_in         = $interestedIn;
        $contact->project_description   = $request->project_description ?? '';
        $contact->venture_or_growth     = $request->venture_or_growth;
        $contact->timeline              = $request->timeline;
        $contact->budget                = $request->budget;
        $contact->extra_details         = $request->extra_details ?? '';
        $contact->other_service_details = $request->other_service_details ?? '';

        try {
            // ✅ Save DB
            $contact->save();

            /* =======================
           GOOGLE SHEET ADD
        ========================*/
            $sheetData = [
                'form_type'             => 'Service Inquiry Form',
                'name'                  => $request->name,
                'company_name'          => $request->company_name,
                'email'                 => $request->email,
                'number'                => $request->number,
                'interested_in'         => $interestedIn,
                'other_service_details' => $request->other_service_details ?? '',
                'venture_or_growth'     => $request->venture_or_growth,
                'timeline'              => $request->timeline,
                'budget'                => $request->budget,
                'project_description'   => $request->project_description ?? '',
                'extra_details'         => $request->extra_details ?? '',
                'date'                  => now()->format('Y-m-d H:i:s'),
            ];

            $sheetUrl = 'https://script.google.com/macros/s/AKfycby-apn4GoPgiU3FFLfwLAY_98-meupkhjTUrNEo5xqxa7CACcNk4ZgOsfiZbswkCoE/exec';

            try {
                $response = Http::timeout(30)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($sheetUrl, $sheetData);

                if (! $response->successful()) {
                    Log::error('Google Sheet request failed', [
                        'status' => $response->status(),
                        'body'   => $response->body(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Google Sheet error: ' . $e->getMessage());
            }

            /* =======================
           SEND MAIL (SAME AS FIRST FORM)
        ========================*/
            try {
                Mail::to($request->email)
                    ->send(new SendContactMailToUser($sheetData));

                Mail::to('webdeveloper10.intelliworkz@gmail.com')
                    ->send(new SendContactMailToAdmin($sheetData));
            } catch (\Exception $e) {
                Log::error('Mail sending failed: ' . $e->getMessage());
            }

            return redirect()
                ->route('thankyou')
                ->with('success', 'Thank you! We\'ll contact you soon.');

        } catch (\Exception $e) {
            Log::error('Contact save failed: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Something went wrong. Please try again.'])
                ->withInput();
        }
    }

    public function thankyou()
    {
        $metatitle       = "";
        $metadescription = "";
        return view('front.thank-you', compact('metatitle', 'metadescription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
