<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nomor_barang',
        'name',
        'description',
        'qty'
    ];
}
