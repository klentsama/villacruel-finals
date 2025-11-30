<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'tv_series_id',
        'status',
        'rented_at',
        'due_at',
        'name',
        'type',
        'images',
        'description',
        'price',
        'is_active',
        'is_popular',
        'in_stock',
        'on_sale',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id');
    }

    public function tvSeries()
    {
        return $this->belongsTo(TvSeries::class, 'tv_series_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genres::class, 'genre_rent', 'rent_id', 'genre_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

