<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rent_id',
        'first_name',
        'last_name',
        'street_address',
        'city',
    ];

    public function rent()
    {
        return $this->belongsTo(Rent::class, 'rent_id');
    }
}
