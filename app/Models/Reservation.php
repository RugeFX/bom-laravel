<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = "reservations";
    protected $fillable = [
        'reservation_code',
        'pickupPlan_code',
        'returnPlan_code',
        'fak_code',
        'helmet_code',
        'motor_code',
        'status',
        'information',
    ];
    public function helmetItems(){
        return $this->belongsToMany(HelmetItem::class,'reservations_helmetItem','reservation_id','helmet_code')->withPivot('helmet_code');
    }

    public function fakItems(){
        return $this->belongsToMany(FakItem::class,'reservations_fakItem','reservation_id','fak_code')->withPivot('fak_code');
    }

    public function motorItems(){
        return $this->belongsToMany(MotorItem::class,'reservesation_motor_item','reservation_id','motor_code')->withPivot('motor_code');
    }

    public function pickup(){
        return $this->belongsTo(Plan::class,'plan_code','pickupPlan_code');
    }

    public function return(){
        return $this->belongsTo(Plan::class,'plan_code','returnPlan_code');
    }

    public static function booted(): void
    {
        static::saved(function (Reservation $reservation) {
            $reservation->load('helmetItems','fakItems','motorItems.general');
            $motorcode = $reservation->motorItems->pluck('code');
            foreach ($motorcode as $c) {
                $motorItem = MotorItem::where('code', $c)->first();
                $generalcode = $motorItem->general->pluck('code');
                $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                $motorItem->update(['plan_code' => $planCode]);
                foreach($generalcode as $c){
                    $generalItem = GeneralItem::where('code', $c)->first();
                    $generalItem->update(['plan_code' => $planCode]);
                }
            }

            // Update Helmet Items
            $helmetcode = $reservation->helmetItems->pluck('code');
            foreach ($helmetcode as $c) {
                $helmetItem = HelmetItem::where('code', $c)->first();
                if ($helmetItem) {
                    $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                    $helmetItem->update(['plan_code' => $planCode]);
                }
            }

            // Update Fak Items
            $fakcode = $reservation->fakItems->pluck('code');
            foreach ($fakcode as $c) {
                $fakItem = FakItem::where('code', $c)->first();
                if ($fakItem) {
                    $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                    $fakItem->update(['plan_code' => $planCode]);
                }
            }

        });
        static::deleting(function (Reservation $reservation) {
            $reservation->motorItems()->detach();
            $reservation->fakItems()->detach();
            $reservation->helmetItems()->detach();
        });
    }
}
