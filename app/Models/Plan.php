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
        'address'
    ];
    public function helmetItems(){
        return $this->hasMany(HelmetItem::class,'plan_code','plan_code');
    }
    public function fakItems(){
        return $this->hasMany(FakItem::class,'plan_code','plan_code');
    }
    public function pickup(){
        return $this->hasMany(Reservation::class,'pickupPlan_code','plan_code');
    }
    public function return(){
        return $this->hasMany(Reservation::class,'returnPlan_code','plan_code');
    }
}
