<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FAQQuestion; 
use App\Models\FAQCategory; 
use App\Http\Controllers\Controller;

class FAQQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $search = $request->input('search');

        $questions = FAQQuestion::query()
            ->where('category_id', $id)
            ->where(function ($query) use ($search) {
                $query->where('question_id', 'LIKE', "%{$search}%")
                    ->orWhere('question', 'LIKE', "%{$search}%")
                    ->orWhere('answer', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('admin.faq.faq_questions', compact('questions', 'id'));
    }

    public function create($category_id)
    {
        return view('admin.faq.faq_question_add', compact('category_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|min:10|max:255',
            'answer' => 'required|string|min:2|max:255',
            'category_id' => 'required|exists:faq_categories,category_id',
        ]);

        FAQQuestion::create($validatedData);

        return redirect()->route('admin.faq.faq_questions.index',  ['id' => $request->category_id])->with('success', 'FAQ Question created successfully.');
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
        $question = FAQQuestion::findOrFail($id);
        $category = FAQCategory::findOrFail($question->category_id);
        return view('admin.faq.faq_question_edit', compact('question', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category_id, $question_id)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|min:10|max:255',
            'answer' => 'required|string|min:2|max:255',
        ]);

        $question = FAQQuestion::findOrFail($question_id);
        $question->update($validatedData);

        return redirect()->route('admin.faq.faq_questions.index',['id'=>$category_id])->with('success', 'FAQ question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = FAQQuestion::findOrFail($id);
        $question->delete();
        
        return redirect()->route('admin.faq.index')->with('success', 'Question deleted successfully.');
    }
}
