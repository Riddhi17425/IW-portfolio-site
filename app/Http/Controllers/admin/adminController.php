<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function admin(){
        $product = Project::whereNull('deleted_at')->count();
        return view('admin.dashboard.admin',compact('product'));
    }
	
}