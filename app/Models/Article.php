<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'slug', 'cover_image'];

    public static function generateSlug($title) {
        return Str::slug($title, '-');
    }
}
