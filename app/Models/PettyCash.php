<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PettyCash extends Model
{
    protected $fillable = [
        'nomor_petty_cash',
        'bulan',
        'jumlah_awal',
        'total_pengeluaran',
        'jumlah_akhir',
        'status',
        'keterangan',
        'created_by',
        'approved_by',
        'tanggal_approved',
    ];

    protected $casts = [
        'bulan' => 'date',
        'tanggal_approved' => 'datetime',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(PettyCashDetail::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
