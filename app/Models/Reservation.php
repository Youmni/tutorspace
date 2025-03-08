<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'participant_id',
        'tutor_id',
        'start_time',
        'end_time',
        'session_type',
        'price',
        'payment_status',
        'status',
        'comments',
        'feedback',
        'material_links',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'material_links' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}
