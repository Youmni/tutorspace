<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.contact.contact_create');
    }

    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'email'=> 'required|email',
            'subject'=> 'required|string|min:5|max:100',
            'message'=> 'required|string|min:20|max:256',
        ]);


        Mail::to(config('mail.admin_address'))->send(new Contact(
            $validatedData['email'],
            $validatedData['subject'],
            $validatedData['message'],
        ));

        return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
