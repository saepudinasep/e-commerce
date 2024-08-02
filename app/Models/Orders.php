<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    // Allow mass assignment for the following fields
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        // Add any other fields you want to allow mass assignment for
    ];

    // Define the relationship with Order_Items
    public function items()
    {
        return $this->hasMany(Order_Items::class, 'order_id');
    }
}
