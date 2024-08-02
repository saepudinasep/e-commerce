<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    // Allow mass assignment for the following fields
    protected $fillable = [
        'id',
        'user_id',
        'total_amount',
        'status',
        'va_number',
        'created_at',
        'updated_at'
        // Add any other fields you want to allow mass assignment for
    ];

    // Define the relationship with Order_Items
    public function items()
    {
        return $this->hasMany(Order_Items::class, 'order_id');
    }

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
