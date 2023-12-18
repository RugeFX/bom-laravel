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

    public function helmet(){
        return $this->belongsToMany(HelmetItem::class,'reservations_helmetItem','reservation_id','id')->withPivot('helmet_code');
    }

    public function fak(){
        return $this->belongsToMany(FakItem::class,'reservations_fakItem','reservation_id','id')->withPivot('fak_code');
    }

    public function motor(){
        return $this->belongsToMany(Helmet::class,'reservations_motorItem','reservation_id','id')->withPivot('motor_code');
    }
}
