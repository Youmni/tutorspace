<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQQuestion extends Model
{
    use HasFactory;

    protected $table = 'faq_questions';

    protected $fillable = [
        'question', 'answer', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'category_id');
    }
}
