<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tabing;
use Illuminate\Http\Request;

class TabingController extends Controller
{
    public function index()
    {
        $tabings = Tabing::with('category')->orderBy('id', 'desc')->paginate(15);

        return view('admin.tabing.tabinglisting', compact('tabings'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.tabing.addtabing', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $tabing = new Tabing();
        $tabing->category_id = $validated['category_id'];
        $tabing->name = $validated['name'];
        $tabing->url = $validated['url'];
        $tabing->status = $validated['status'];
        $tabing->save();

        return redirect()->route('tabing.index')->with('success', 'Tabing added successfully.');
    }

    public function edit($id)
    {
        $tabing = Tabing::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('admin.tabing.edittabing', compact('tabing', 'categories'));
    }
    
    public function show($id)
    {
        return redirect()->route('tabing.edit', $id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $tabing = Tabing::findOrFail($id);
        $tabing->category_id = $validated['category_id'];
        $tabing->name = $validated['name'];
        $tabing->url = $validated['url'];
        $tabing->status = $validated['status'];
        $tabing->save();

        return redirect()->route('tabing.index')->with('success', 'Tabing updated successfully.');
    }

    public function destroy($id)
    {
        $tabing = Tabing::findOrFail($id);
        $tabing->delete();

        return redirect()->back()->with('success', 'Tabing deleted successfully.');
    }
}