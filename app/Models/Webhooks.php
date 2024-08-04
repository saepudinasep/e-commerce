<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhooks extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'event',
        'payload'
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    // Define the relationship with Orders
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
