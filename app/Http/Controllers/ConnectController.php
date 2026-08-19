<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ConnectInquiry;

class ConnectController extends Controller
{
    public function store(Request $request)
    {
         $request->validate([
        'name'           => ['required', 'string', 'max:70', 'regex:/^[a-zA-Z\s]+$/'],
        'contact_number' => ['required', 'string', 'regex:/^[0-9]{8,15}$/'],        'country_code'   => ['required', 'string', 'max:5', 'regex:/^\+[0-9]{1,4}$/'],
        'email'          => ['required', 'email', 'max:255'],
        'message'        => ['nullable', 'string', 'max:2000'],
        'captcha_answer' => ['required', 'numeric'],
    ], [
        'name.required'           => 'Please enter your name.',
        'name.regex'              => 'Name must contain only letters and spaces.',
        'contact_number.required' => 'Please enter your contact number.',
        'contact_number.regex'    => 'Contact number must be 8 to 15 digits only.',
        'country_code.required'   => 'Please select a country code.',
        'email.required'          => 'Please enter your email address.',
        'email.email'             => 'Please enter a valid email address.',
        'captcha_answer.required' => 'Please answer the security question.',
    ]);

    if ((int) $request->captcha_answer !== (int) session('math_captcha_answer')) {
        return back()
            ->withErrors(['captcha_answer' => 'Incorrect answer. Please try again.'])
            ->withInput();
    }

    session()->forget('math_captcha_answer');

    try {
        ConnectInquiry::create([
            'name'           => $request->name,
            'contact_number' => $request->contact_number,
            'country_code'   => $request->country_code,
            'email'          => $request->email,
            'message'        => $request->message,
        ]);

        return redirect()->route('thankyou')->with('success', 'Thank you for reaching out! Our team will get back to you shortly.');

    } catch (\Exception $e) {
        Log::error('Connect inquiry save failed: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Something went wrong. Please try again later.'])->withInput();
    }
}
}