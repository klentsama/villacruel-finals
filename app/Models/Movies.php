<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_year',
        'image',
        'genre_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genres::class, 'genre_id');
    }


}
