<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Items extends Model
{
    use HasFactory;
    // Allow mass assignment for the following fields
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        // Add any other fields you want to allow mass assignment for
    ];

    // Define relationships if needed
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
