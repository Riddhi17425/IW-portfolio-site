<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use Illuminate\Support\Facades\Http;
use Google\Client;
use Google\Service\Sheets;
use App\Services\GoogleSheetsService;

use Illuminate\Support\Facades\Log;
use App\Mail\SendContactMailToAdmin;
use App\Mail\SendContactMailToUser;
use App\Models\Industry;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use App\Models\KeyFeature;
use App\Models\Tabing;
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
        $categories = Category::orderBy('name')->get();
        $industries = Industry::orderBy('title')->get();
        $tabings = $this->getActiveTabings();

        $projects = Project::with(['industry'])
            ->when($request->filled('category') && $request->category !== 'all', function ($query) use ($request) {
                $query->whereRaw('FIND_IN_SET(?, category_id)', [$request->category]);
            })
            ->when($request->filled('industry') && $request->industry !== 'all', function ($query) use ($request) {
                $query->where('industry_id', $request->industry);
            })
            ->oldest()
            ->get();
    
            if ($request->ajax()) {
                return response()->json([
                    'projects' => $projects,
                    'industries' => $industries,
                    'tabings' => $tabings,
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
        $project  = Project::where('url', $projectUrl)->firstOrFail();
    
        $project->product_images = json_decode($project->product_image, true) ?? [];

        $sector = $project->sector ? array_map('trim', explode(',', $project->sector)) : [];

        $nextProject = Project::where('id', '!=', $project->id)
                              ->whereNull('deleted_at')
                              ->inRandomOrder()
                              ->first();
    
        return view('front.projectdetail', compact('project', 'nextProject', 'sector'));
    }


 public function contact()
{
    $metatitle = "";
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

    $contact = new Contact();
    $contact->name = $request->name;
    $contact->company_name = $request->company_name;
    $contact->email = $request->email;
    $contact->number = $request->number;
    $contact->interested_in = $interestedIn;
    $contact->project_description = $request->project_description ?? '';
    $contact->venture_or_growth = $request->venture_or_growth;
    $contact->timeline = $request->timeline;
    $contact->budget = $request->budget;
    $contact->extra_details = $request->extra_details ?? '';
    $contact->other_service_details = $request->other_service_details ?? '';

    try {
        // ✅ Save DB
        $contact->save();

        /* =======================
           GOOGLE SHEET ADD
        ========================*/
        $sheetData = [
            'form_type'              => 'Service Inquiry Form',
            'name'                   => $request->name,
            'company_name'           => $request->company_name,
            'email'                  => $request->email,
            'number'                => $request->number,
            'interested_in'          => $interestedIn,
            'other_service_details'  => $request->other_service_details ?? '',
            'venture_or_growth'      => $request->venture_or_growth,
            'timeline'               => $request->timeline,
            'budget'                 => $request->budget,
            'project_description'    => $request->project_description ?? '',
            'extra_details'          => $request->extra_details ?? '',
            'date'                   => now()->format('Y-m-d H:i:s'),
        ];

        $sheetUrl = 'https://script.google.com/macros/s/AKfycby-apn4GoPgiU3FFLfwLAY_98-meupkhjTUrNEo5xqxa7CACcNk4ZgOsfiZbswkCoE/exec';

        try {
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($sheetUrl, $sheetData);

            if (!$response->successful()) {
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
        $metatitle ="";
        $metadescription="";
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
    