<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\PortfolioProject;
use App\Models\PortfolioProjectMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioProjectController extends Controller
{
    public function index()
    {
        $projects = PortfolioProject::orderBy('created_at', 'desc')->whereNull('deleted_at')->paginate(15);
        return view('admin.portfolio.index', compact('projects'));
    }

    public function create()
    {
        $industries = Industry::whereNull('deleted_at')->get();
        $mediaTypes = config('portfolio.media_types');
        return view('admin.portfolio.create', compact('industries', 'mediaTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'url'            => 'required|string|max:255|unique:portfolio_projects,url',
            'hero_model'     => [
                'nullable',
                'file',
                function ($attribute, $value, $fail) {
                    if ($value && ! in_array(strtolower($value->getClientOriginalExtension()), ['glb', 'gltf'])) {
                        $fail('The hero model must be a .glb or .gltf file.');
                    }
                },
            ],
            'banner_image'   => 'nullable|image|max:5120',
            'listing_image'  => 'nullable|image|max:5120',
            'media.*.type'   => 'nullable|string',
            'media.*.file.*' => 'nullable|file|max:20480',
        ]);

        $post = new PortfolioProject;
        $this->fillCommonFields($post, $request);

        if ($request->hasFile('hero_model')) {
            $post->hero_model = $this->uploadFile($request->file('hero_model'), 'newportfolio/hero_models');
        }

        if ($request->hasFile('banner_image')) {
            $post->banner_image = $this->uploadFile($request->file('banner_image'), 'newportfolio/banners');
        }

        if ($request->hasFile('listing_image')) {
            $post->listing_image = $this->uploadFile($request->file('listing_image'), 'newportfolio/listing');
        }

        $post->save();

        $this->saveMediaRows($request, $post, false);

        return redirect()->route('portfolio.index')->with('success', 'Project Added Successfully');
    }

    public function edit($id)
    {
        $data                = PortfolioProject::with('media')->findOrFail($id);
        $groupedMedia        = $data->media->groupBy('media_group');
        $industries          = Industry::whereNull('deleted_at')->get();
        $mediaTypes          = config('portfolio.media_types');
        $selectedIndustryIds = $data->industry_ids_array;
        return view('admin.portfolio.edit', compact('data', 'industries', 'mediaTypes', 'selectedIndustryIds', 'groupedMedia'));
    }

    public function update(Request $request, $id)
    {
        $post = PortfolioProject::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'url'            => 'required|string|max:255|unique:portfolio_projects,url,' . $post->id,
            'hero_model'     => [
                'nullable',
                'file',
                function ($attribute, $value, $fail) {
                    if ($value && ! in_array(strtolower($value->getClientOriginalExtension()), ['glb', 'gltf'])) {
                        $fail('The hero model must be a .glb or .gltf file.');
                    }
                },
            ],
            'banner_image'   => 'nullable|image|max:5120',
            'listing_image'  => 'nullable|image|max:5120',
            'media.*.type'   => 'nullable|string',
            'media.*.file.*' => 'nullable|file|max:20480',
        ]);

        $this->fillCommonFields($post, $request);

        if ($request->hasFile('hero_model')) {
            $post->hero_model = $this->uploadFile($request->file('hero_model'), 'newportfolio/hero_models');
        }

        if ($request->hasFile('banner_image')) {
            $post->banner_image = $this->uploadFile($request->file('banner_image'), 'newportfolio/banners');
        }

        if ($request->hasFile('listing_image')) {
            $post->listing_image = $this->uploadFile($request->file('listing_image'), 'newportfolio/listing');
        }

        $post->save();

        $this->saveMediaRows($request, $post, true);

        return redirect()->route('portfolio.index')->with('success', 'Project Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = PortfolioProject::find($id);
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Project Deleted Successfully!');
        }

        return redirect()->back()->with('error', 'Project not found!');
    }

    /* ---------------- helpers ---------------- */

    private function fillCommonFields(PortfolioProject $post, Request $request)
    {
        $post->name                  = $request->get('name');
        $post->url                   = $request->get('url');
        $post->hero_heading          = $request->get('hero_heading');
        $post->hero_description      = $request->get('hero_description');
        $post->overview_description  = $request->get('overview_description');
        $post->industry_ids          = $request->has('industry_id') ? implode(',', $request->get('industry_id')) : null;
        $post->services              = $request->get('services'); // JSON string built by the tag-input JS
        $post->challenge_description = $request->get('challenge_description');
        $post->approach_description  = $request->get('approach_description');
        $post->gallery_heading       = $request->get('gallery_heading');
        $post->gallery_description   = $request->get('gallery_description');
        $post->status                = $request->has('status') ? 1 : 0;
    }

    private function uploadFile($file, $folder)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $path     = public_path($folder);
        if (! File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
        $file->move($path, $filename);
        return $filename;
    }

    private function saveMediaRows(Request $request, PortfolioProject $post, bool $isUpdate)
    {
        $rows          = $request->input('media', []);
        $files         = $request->file('media', []);
        $extensionsMap = config('portfolio.media_type_extensions');

        if ($isUpdate) {
            $post->media()->delete();
        }

        if (empty($rows)) {
            return;
        }

        foreach ($rows as $index => $row) {
            $type  = $row['type'] ?? null;
            $title = $row['title'] ?? null;

            if (! $type) {
                continue;
            }

            $groupKey = (string) \Illuminate\Support\Str::uuid();

            $uploadedFiles = $files[$index]['file'] ?? [];
            $uploadedFiles = is_array($uploadedFiles) ? array_filter($uploadedFiles) : [];

            if (empty($uploadedFiles)) {
                // No new files chosen for this row — keep whatever existing files it had
                $existingPaths = $row['existing_file'] ?? [];
                $existingPaths = is_array($existingPaths) ? array_filter($existingPaths) : array_filter([$existingPaths]);

                foreach (array_values($existingPaths) as $sub => $path) {
                    PortfolioProjectMedia::create([
                        'portfolio_project_id' => $post->id,
                        'title'                => $title,
                        'media_type'           => $type,
                        'file_path'            => $path,
                        'media_group'          => $groupKey,
                        'sort_order'           => $index * 100 + $sub,
                    ]);
                }
                continue;
            }

            // New files selected — they replace whatever this row had before
            foreach (array_values($uploadedFiles) as $sub => $uploadedFile) {
                $ext = strtolower($uploadedFile->getClientOriginalExtension());

                if (isset($extensionsMap[$type]) && ! in_array($ext, $extensionsMap[$type])) {
                    continue;
                }

                $filePath = $this->uploadFile($uploadedFile, 'newportfolio/media/' . $type);

                PortfolioProjectMedia::create([
                    'portfolio_project_id' => $post->id,
                    'title'                => $title,
                    'media_type'           => $type,
                    'file_path'            => $filePath,
                    'media_group'          => $groupKey,
                    'sort_order'           => $index * 100 + $sub,
                ]);
            }
        }
    }
}
