<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offer;

class Bid extends Model
{
    use HasFactory;

    public function getBids()
    {
        return $this->belongsTo(Offer::class, 'offers_id');
    }

    public function getCompany()
    {
        return $this->belongsTo(Company::class, 'companys_id');
    }

    public function getWinner()
    {
        return $this->hasMany(Winner::class, 'bid_id');
    }
}
