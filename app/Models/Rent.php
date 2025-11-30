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
        'due_date',
        'status',
    ];  


    public function movie()
    {
        return $this->belongsTo(Movies::class);
    }

    public function tvSeries()
    {
        return $this->belongsTo(TvSeries::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
