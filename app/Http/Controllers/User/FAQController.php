<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQCategory; 
use App\Models\FAQQuestion; 


class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FAQCategory::all();
        return view('user.faq.faq', compact('categories'));    
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
    public function show($id)
    {
        $questions = FAQQuestion::where('category_id', $id)->get();
        return view('user.faq.faq_questions', compact('questions', 'id'));
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
