<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_id',
        'movie_id',
        'tv_series_id',
        'quantity',
        'price',
        'total',
    ];

    public function rent()
    {
        return $this->belongsTo(Rent::class, 'rent_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id');
    }

    public function tvSeries()
    {
        return $this->belongsTo(TvSeries::class, 'tv_series_id');
    }


    public function item()
    {
        return $this->belongsTo(Rent::class, 'rent_id');
    }


}
