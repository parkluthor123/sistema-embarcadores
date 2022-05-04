<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Affiliate;
use App\Models\Offer;

class Shipper extends Model
{
    use HasFactory;
    
    public function shipperAffiliate()
    {
        return $this->hasMany(Affiliate::class, 'shippers_id');
    }
    
}
