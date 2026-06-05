<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryStock extends Model
{
    protected $fillable = [
        'barang_id',
        'type',
        'quantity',
        'tanggal',
        'keterangan',
        'status',
        'created_by',
        'approved_by',
        'tanggal_approved',
        'catatan_approval',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_approved' => 'datetime',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
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
