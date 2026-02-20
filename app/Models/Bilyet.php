<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bilyet extends Model
{
    protected $fillable = [
        'nomor_bilyet',
        'nama_bank',
        'jumlah',
        'tanggal_terbit',
        'tanggal_jatuh_tempo',
        'keterangan',
        'user_id',
        'customer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
