<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_code',
        'name',
        'location'
    ];
    public function pickup(){
        return $this->hasMany(Reservation::class,'pickupPlan_code','plan_code');
    }
    public function return(){
        return $this->hasMany(Reservation::class,'returnPlan_code','plan_code');
    }
}
