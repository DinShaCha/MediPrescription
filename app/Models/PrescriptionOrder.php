<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionOrder extends Model
{
    protected $fillable = ['order_id', 'prescription_id'];
}
