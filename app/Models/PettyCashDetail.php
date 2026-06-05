<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PettyCashDetail extends Model
{
    protected $fillable = [
        'petty_cash_id',
        'tanggal_pengeluaran',
        'keterangan_pengeluaran',
        'jumlah_pengeluaran',
        'penerima',
        'created_by',
    ];

    protected $casts = [
        'tanggal_pengeluaran' => 'date',
    ];

    public function pettyCash(): BelongsTo
    {
        return $this->belongsTo(PettyCash::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
