<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renters extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rents()
    {
        return $this->hasMany(Rent::class, 'renter_id');
    }

    public function item()
    {
        return $this->hasMany(Rent::class, 'renter_id'); 
    }

}
