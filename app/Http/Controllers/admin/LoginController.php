<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Str;
class LoginController extends Controller
{ 
    public function register_page(){
        return view('admin.auth.signup');
    }

    function login_page(){
        // return "Login page function called";
        return view('admin.auth.login');
    }

    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'profile_picture' => 'required|mimetypes:image/jpeg,image/png,image/webp|max:2048',

        ]);

        if ($validate->fails()) {
            return redirect('register')
                ->withErrors($validate) 
                ->withInput(); 
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = Str::uuid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('admin/user/profile'), $imageName);
            $image_url = 'public/admin/user/profile/'.$imageName;
        }

        $user = new User();
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->password = Hash::make($request->password);
        $user->role =  3;
        $user->profile = $image_url ?? '';
        $user->user_key = $request->password;
        $user->save();
 
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        // return "Login function called";
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect('login')
                ->withErrors($validate)
                ->withInput();
        }

        $credentials = $request->only('email', 'password'); 

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Invalid login
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

