<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorCourse extends Model
{
    use HasFactory;

    protected $table = 'tutor_courses';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'course_id',
    ];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}