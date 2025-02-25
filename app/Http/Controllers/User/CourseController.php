<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course; 
use App\Models\Institution; 
use App\Models\TutorCourse; 


class CourseController extends Controller
{
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
    
}
