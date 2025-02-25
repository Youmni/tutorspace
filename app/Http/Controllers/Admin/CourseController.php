<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course; 
use App\Models\Institution; 


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $courses = Course::with('institution')
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhereHas('institution', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->get();
            
        return view('admin.course.courses', compact('courses'));
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $courses = Course::with('institution')
                        ->where('title', 'LIKE', '%' . $query . '%')
                        ->orWhereHas('institution', function ($q) use ($query) {
                            $q->where('name', 'LIKE', '%' . $query . '%');
                        })
                        ->get();

        return response()->json(['courses' => $courses]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutions = Institution::all();
        return view('admin.course.courses_add', compact('institutions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:2|max:100',
            'description' => 'required|string|min:20|max:255',
            'institution_id' => 'required|exists:institutions,institution_id',
        ]);
    
        Course::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'institution_id' => $validatedData['institution_id'],
        ]);
    
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
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
        $institutions = Institution::all();
        $course = Course::findOrFail($id);
        return view('admin.course.courses_edit', compact('course', 'institutions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:2|max:100',
            'description' => 'required|string|min:20|max:255',
            'institution_id' => 'required|exists:institutions,institution_id',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validatedData);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
