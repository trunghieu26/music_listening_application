<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SongChart extends Model
{
    use HasFactory;

    protected $fillable = [
        'song_id',
        'chart_id',
    ];

    public function chart(): HasOne
    {
        return $this->hasOne(Chart::class);
    }

    public function song(): HasOne
    {
        return $this->hasOne(Song::class);
    }
}
