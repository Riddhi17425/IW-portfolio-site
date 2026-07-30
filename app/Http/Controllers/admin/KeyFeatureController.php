<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KeyFeature;

class KeyFeatureController extends Controller
{
    public function index()
    {
        $keyfeatures = KeyFeature::orderBy('id','desc')->paginate(15); 
        return view('admin.keyfeature.keyfeaturelisting', compact('keyfeatures'));
    }

    public function create()
    {
        return view('admin.keyfeature.addkeyfeature'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $keyfeature = new KeyFeature();
        $keyfeature->name = $request->name;

        $keyfeature->save();
        return redirect()->route('keyfeature.index')->with('success','KeyFeature added successfully.');
    }

    public function edit($id)
    {
        $keyfeatures = KeyFeature::findOrFail($id);
        return view('admin.keyfeature.editkeyfeature', compact('keyfeatures'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $keyfeature = KeyFeature::findOrFail($id);
        $keyfeature->name = $request->name;

        $keyfeature->save();
        return redirect()->route('keyfeature.index')->with('success','KeyFeature updated successfully.');
    }

    public function destroy($id)
    {
        $keyfeature = KeyFeature::findOrFail($id);
        $keyfeature->delete(); 
        return redirect()->back()->with('success','KeyFeature deleted successfully.');
    }
}
