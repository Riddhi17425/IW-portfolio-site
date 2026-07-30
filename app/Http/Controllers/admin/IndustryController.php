<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Industry;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::orderBy('id','desc')->paginate(15); 
        return view('admin.industry.industrylisting', compact('industries'));
    }

    public function create()
    {
         $categories = Category::orderBy('name')->get();
        return view('admin.industry.addindustry',compact('categories')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);

        $industry = new Industry();
        $industry->category_id = implode(',', $request->category_id);
        $industry->title = $request->title;
        $industry->url = $request->url;

        $industry->save();
        return redirect()->route('industry.index')->with('success','industry added successfully.');
    }

    public function edit($id)
    {
        $industry = Industry::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.industry.editindustry', compact('industry','categories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required'
        ]);

        $industry = Industry::findOrFail($id);
        $industry->category_id = implode(',', $request->category_id);
        $industry->title = $request->title;
        $industry->url = $request->url;

        $industry->save();
        return redirect()->route('industry.index')->with('success','industry updated successfully.');
    }

    public function destroy($id)
    {
        $industry = Industry::findOrFail($id);
        $industry->delete(); 
        return redirect()->back()->with('success','industry deleted successfully.');
    }
}
