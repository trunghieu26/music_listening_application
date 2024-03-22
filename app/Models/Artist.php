<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'url_image',
        'count_like'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
