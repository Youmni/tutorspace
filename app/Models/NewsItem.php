<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    protected $table = 'newsitems';

    protected $fillable = [
        'title', 'content', 'image_path', 'publication_date',
    ];
}
