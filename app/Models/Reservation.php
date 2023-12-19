<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_code',
        'pickupPlan_code',
        'returnPlan_code',
        'fak_code',
        'helmet_code',
        'motor_code'
    ];

    public function helmetItems(){
        return $this->belongsToMany(HelmetItem::class,'reservations_helmetItem','reservation_id','id')->withPivot('helmet_code');
    }

    public function fakItems(){
        return $this->belongsToMany(FakItem::class,'reservations_fakItem','reservation_id','id')->withPivot('fak_code');
    }

    public function motorItems(){
        return $this->belongsToMany(Helmet::class,'reservations_motorItem','reservation_id','id')->withPivot('motor_code');
    }

    public function pickup(){
        return $this->belongsTo(Plan::class,'plan_code','pickupPlan_code');
    }

    public function return(){
        return $this->belongsTo(Plan::class,'plan_code','returnPlan_code');
    }
}
