<?php

namespace App\Models;

class FAQQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'answer', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'category_id');
    }
}
