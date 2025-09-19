<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETicket extends Model
{
    /** @use HasFactory<\Database\Factories\ETicketFactory> */
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'qr_code',
        'status',
        'used_at'
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
