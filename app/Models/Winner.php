<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    public function getBids()
    {
        return $this->belongsTo(Bid::class, 'companys_id');
    }

    public function getCompany()
    {
        return $this->belongsTo(Company::class, 'companys_id');
    }
}
