<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nomor_customer',
        'name',
        'address',
        'phone',
    ];

    public function bilyets()
    {
        return $this->hasMany(Bilyet::class);
    }
}
