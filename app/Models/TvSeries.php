<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_year',
        'genre_id',
        'image',
    ];

    public function genre()
    {
        return $this->belongsTo(Genres::class, 'genre_id');
    }
}
