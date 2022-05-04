<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public function getBid()
    {
        return $this->hasMany(Bid::class, 'offers_id');
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shippers_id');
    }
}
