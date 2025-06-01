<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['prescription', 'note', 'delivery_address', 'delivery_time', 'user_id', 'status'];

    protected $casts = ['prescription' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'prescription_orders')
            ->withTimestamps();
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'prescription_medicines')
            ->withPivot('quantity', 'total_price')
            ->withTimestamps();
    }
}
