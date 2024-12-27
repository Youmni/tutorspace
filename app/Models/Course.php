<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'institution_id',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function tutorCourses()
    {
        return $this->belongsToMany(User::class, 'tutor_course', 'course_id', 'user_id');
    }
}