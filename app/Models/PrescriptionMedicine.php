<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicine extends Model
{

    protected $fillable = ['prescription_id','medicine_id', 'quantity', 'total_price'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

}
