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
        'hardcase_code',
        'status',
        'information',
    ];
    public function helmetItems(){
        return $this->belongsToMany(HelmetItem::class,'reservations_helmetItem','reservation_id','helmet_code')->withPivot('helmet_code','status');
    }

    public function fakItems(){
        return $this->belongsToMany(FakItem::class,'reservations_fakItem','reservation_id','fak_code')->withPivot('fak_code','status');
    }

    public function hardcaseItems(){
        return $this->belongsToMany(HardcaseItem::class,'reservations_hardcaseitem','reservation_id','hardcase_code')->withPivot('hardcase_code','status');
    }

    public function motorItems(){
        return $this->belongsToMany(MotorItem::class,'reservesation_motor_item','reservation_id','motor_code')->withPivot('motor_code','status');
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
            $reservation->load('helmetItems', 'fakItems', 'motorItems.general','hardcaseItems');
        
            // Update Motor Items
            if (!is_null($reservation->motorItems)) {
                foreach ($reservation->motorItems as $motorItem) {
                    $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                    $status =  $motorItem->pivot->status ?? 'In Rental';
            
                    $motorItem->update([
                        'plan_code' => $planCode,
                        'status' => $status,
                    ]);
                }
            
                // Update General Items
                foreach ($reservation->motorItems as $motorItem) {
                    foreach ($motorItem->general as $generalItem) {
                        $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                        $status = $motorItem->pivot->status ?? 'In Rental';
            
                        $generalItem->update([
                            'plan_code' => $planCode,
                            'status' => $status,
                        ]);
                    }
                }
            }
            
            if(!is_null($reservation->helmetItems)){
                // Update Helmet Items
                foreach ($reservation->helmetItems as $helmetItem) {
                    if ($helmetItem) {
                        $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                        $status = $helmetItem->pivot->status ?? 'In Rental';
            
                        $helmetItem->update([
                            'plan_code' => $planCode,
                            'status' => $status,
                        ]);
                    }
                }
            }

            if(!is_null($reservation->hardcaseItems)){
                foreach ($reservation->hardcaseItems as $hardcaseItem) {
                    if ($hardcaseItem) {
                        $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                        $status = ($motorItem->pivot->status === 'Out Of Service') ? $motorItem->pivot->status : ($hardcaseItem->pivot->status ?? 'In Rental');
            
                        $hardcaseItem->update([
                            'plan_code' => $planCode,
                            'status' => $status,
                        ]);
                    }
                }
            }
            if(!is_null($reservation->fakItems)){
                foreach ($reservation->fakItems as $fakItem) {
                    if ($fakItem) {
                        $planCode = $reservation->returnPlan_code ?? $reservation->pickupPlan_code;
                        $status =  $fakItem->pivot->status ?? 'In Rental';
            
                        $fakItem->update([
                            'plan_code' => $planCode,
                            'status' => $status,
                        ]);
                    }
                }
            }
        });
        static::deleting(function (Reservation $reservation) {
            $reservation->motorItems()->detach();
            $reservation->fakItems()->detach();
            $reservation->helmetItems()->detach();
            $reservation->hardcaseItems()->detach();
        });
    }
}
