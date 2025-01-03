<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    use HasFactory;
    protected $table = 'news_items';

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'title', 'content', 'image_path', 'publication_date',
    ];
}
