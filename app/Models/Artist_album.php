<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist_album extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'artists_id',
        'album_type',
        'external_urls',
        'href',
        'images',
        'name',
        'release_date',
        'total_tracks'
    ];
}
