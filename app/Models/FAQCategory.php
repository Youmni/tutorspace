<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    protected $table = 'faq_categories';


    protected $fillable = [
        'name',
    ];
}
