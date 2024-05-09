<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Top_track extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'preview_url',
        'album_id',
        'artist_id',
        'href',
        'name'
    ];
}
