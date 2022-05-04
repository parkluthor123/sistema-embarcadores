<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Shipper;
use App\Models\Company;
use App\Models\Offer;


class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'employees';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shippers_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companys_id');
    }

    public function offer()
    {
        return $this->hasMany(Offer::class, 'employees_id');
    }

}
