<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PlaylistSong extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_id',
        'song_id',
    ];

    public function song(): HasOne
    {
        return $this->hasOne(Song::class);
    }

    public function playlist(): HasOne
    {
        return $this->hasOne(Playlist::class);
    }
}
