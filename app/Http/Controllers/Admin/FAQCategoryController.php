<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FAQCategory; 
use App\Http\Controllers\Controller;

class FAQCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = FAQCategory::query()
            ->where('category_id', 'LIKE', "%{$search}%")
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->get();

        return view('admin.faq.faq', compact('categories'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.faq_category_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required|string|max:255',
        ]);

        FAQCategory::create($validatedData);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ Category created successfully.');
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
    public function edit($id)
    {
        $category = FAQCategory::findOrFail($id);
        return view('admin.faq.faq_category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = FAQCategory::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = FAQCategory::findOrFail($id);
        $category->delete();
        
        return redirect()->route('admin.faq.index')->with('success', 'Category deleted successfully.');
    }
}
