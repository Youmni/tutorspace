<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course; 
use App\Models\Institution; 

class UserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $institution_id = $request->input('institution');
        $country = $request->input('country');
        $courses = Course::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%")
                             ->orWhereHas('institution', function ($query) use ($search) {
                                 $query->where('name', 'LIKE', "%{$search}%");
                             });
            })
            ->get();

        $institutions = Institution::all();
        $countries = Institution::distinct()->pluck('country');

        return view('user.course.courses', compact('courses', 'institutions', 'countries'));
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
