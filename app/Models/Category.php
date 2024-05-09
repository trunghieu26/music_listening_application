<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'href',
        'name',
        'icons'
    ];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
