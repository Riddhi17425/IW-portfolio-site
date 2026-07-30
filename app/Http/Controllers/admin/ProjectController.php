<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\KeyFeature;
use App\Models\Industry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\Tabing;

class ProjectController extends Controller
{
    public function index()
    {
        $products = Project::with('category')->paginate(15);
        return view('admin.product.productlisting', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $industries = Industry::orderBy('title')->get();
        $keyfeatures = KeyFeature::orderBy('name')->get();
        $tabings = $this->getTabings();

        return view('admin.product.addproduct', compact('categories', 'keyfeatures', 'industries', 'tabings'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|array|min:1',
                'category_id.*' => 'exists:categories,id',
                'name' => 'required|string|max:255',
                'url' => 'required|string|max:255',
                'tabing_id' => 'nullable|array',
                'tabing_id.*' => 'integer'
            ]);

            if ($errorResponse = $this->validateTabingForCategories($request)) {
                return $errorResponse;
            }

            $product = new Project();
            $product->name = $request->name;
            $product->url = $request->url;
            $product->category_id = implode(',', $request->category_id);
            $product->tabing_id = $this->formatTabingIds($request->input('tabing_id', []));
            $product->industry_id = $request->industry_id;
            $product->description = $request->description;
            $product->detail_description = $request->detail_description;
            $product->website_url = $request->website_url;
            $product->linkedin_link = $request->linkedin_link;
             $product->instagram_link = $request->instagram_link;
              $product->facebook_link = $request->facebook_link;
              $product->phone = $request->phone;
            $product->sector = $request->sector;
            //$product->technology = $request->technology;

            if ($request->hasFile('product_image')) {
            $imagePaths = [];
            foreach ($request->file('product_image') as $image) {
                $filename = $image->getClientOriginalName();
                $image->move(public_path('product_multiple_images'), $filename);  // Store images in public/product_images
                $imagePaths[] = $filename;
            }
            $product->product_image = json_encode($imagePaths); // Store the array of image paths as JSON
        }

            if ($request->hasFile('image')) {
                $filename = $request->image->getClientOriginalName();
                $request->image->move(public_path('product_images'), $filename);
                $product->image = $filename;
            }
            // if ($request->hasFile('detail_image')) {
            //     $filename = $request->detail_image->getClientOriginalName();
            //     $request->detail_image->move(public_path('product_detail_images'), $filename);
            //     $product->detail_image = $filename;
            // }
               //$product->keyfeature = json_encode($request->keyfeature ?: null);
              
        
            
            $product->save();

            return redirect()->route('product.index')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            Log::error('Product store failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'files' => $request->file()
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to add product: ' . $e->getMessage());
        }
    }

        public function edit($id)
        {
            $product = Project::findOrFail($id);
            $categories = Category::orderBy('name')->get();
            $industries = Industry::orderBy('title')->get();
            $keyfeatures = KeyFeature::orderBy('name')->get();
            $tabings = $this->getTabings();
            $selectedKeyFeatures = json_decode($product->keyfeature, true) ?? []; 
            $selectedTabingIds = array_values(array_filter(explode(',', (string) $product->tabing_id)));

            return view('admin.product.editproduct', compact('product', 'categories', 'industries', 'keyfeatures', 'selectedKeyFeatures', 'tabings', 'selectedTabingIds'));
        }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'category_id' => 'required|array|min:1',
                'category_id.*' => 'exists:categories,id',
                'name' => 'required|string|max:255',
                'url' => 'required|string|max:255',
                'tabing_id' => 'nullable|array',
                'tabing_id.*' => 'integer'
            ]);

            if ($errorResponse = $this->validateTabingForCategories($request)) {
                return $errorResponse;
            }

            $product = Project::findOrFail($id);
            $product->name = $request->name;
            $product->url = $request->url;
            $product->category_id = implode(',', $request->category_id);
            $product->tabing_id = $this->formatTabingIds($request->input('tabing_id', []));
            $product->industry_id = $request->industry_id;
            $product->description = $request->description;
            $product->detail_description = $request->detail_description;
            $product->website_url = $request->website_url;
            $product->linkedin_link = $request->linkedin_link;
             $product->instagram_link = $request->instagram_link;
              $product->facebook_link = $request->facebook_link;
               $product->phone = $request->phone;
            $product->sector = $request->sector;
            //$product->technology = $request->technology;
            
            
            if ($request->hasFile('image')) {
                $filename = $request->image->getClientOriginalName();
                $request->image->move(public_path('product_images'), $filename);
                $product->image = $filename;
            }
            // if ($request->hasFile('detail_image')) {
            //     $filename = $request->detail_image->getClientOriginalName();
            //     $request->detail_image->move(public_path('product_detail_images'), $filename);
            //     $product->detail_image = $filename;
            // }

            if ($request->hasFile('product_image')) {
            $imagePaths = [];
            foreach ($request->file('product_image') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('product_multiple_images'), $filename);
                $imagePaths[] = $filename;
            }
            $product->product_image = json_encode($imagePaths);
        }

            //$product->keyfeature = json_encode($request->keyfeature ?: null);
            $product->save();

            return redirect()->route('product.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            Log::error('Product update failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'files' => $request->file()
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Project::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            Log::error('Product delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    protected function getTabings()
    {
        if (! Schema::hasTable('tabings')) {
            return collect();
        }

        return Tabing::where('status', 1)
            ->orderBy('name')
            ->get(['id', 'category_id', 'name']);
    }

    protected function validateTabingForCategories(Request $request)
    {
        if (! $request->filled('tabing_id') || ! Schema::hasTable('tabings')) {
            return null;
        }

        $selectedCategoryIds = collect($request->input('category_id', []))
            ->filter()
            ->map(function ($id) {
                return (int) $id;
            })
            ->values()
            ->all();

        $selectedTabingIds = collect($request->input('tabing_id', []))
            ->filter()
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values()
            ->all();

        if (empty($selectedTabingIds)) {
            return null;
        }

        $validTabingCount = Tabing::whereIn('id', $selectedTabingIds)
            ->whereIn('category_id', $selectedCategoryIds)
            ->count();

        if ($validTabingCount === count($selectedTabingIds)) {
            return null;
        }

        return redirect()->back()
            ->withInput()
            ->withErrors(['tabing_id' => 'Selected tabings do not belong to the selected category.']);
    }

    protected function formatTabingIds(array $tabingIds)
    {
        $ids = collect($tabingIds)
            ->filter()
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values()
            ->all();

        return empty($ids) ? null : implode(',', $ids);
    }
}