<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MotorItem extends Model
{
    use HasFactory;
    protected $table = "motorItems";
    protected $primaryKey = 'code'; 
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'code',
        'bom_code',
        'name',
        'plan_code',
        'hardcase_code',
        'general_code',
        'status',
        'information',
    ];
    public function bom(){
        return $this->belongsTo(Bom::class,'bom_code','bom_code');
    }
    public function reservation(){
        return $this->belongsToMany(Reservation::class,'reservesation_motor_item','motor_code','reservation_id');
    }
    public function general(){
        return $this->belongsToMany(GeneralItem::class,'motorItem_generalItem','code','general_code')->withPivot('general_code');
    }
    public function plan(){
        return $this->belongsTo(Plan::class,'plan_code','plan_code');
    }
    public function hardcase(){
        return $this->belongsTo(HardcaseItem::class,'hardcase_code','code');
    }
    public static function booted(): void
    {
        static::saved(function (MotorItem $motorItem) {
            $motorItem->load('general','hardcase');
            $status = $motorItem->status;
            foreach ($motorItem->general as $generalItem) {
                $generalItem->update([
                    'plan_code' => $motorItem->plan_code,
                    'status' => $status,
                ]);
            }
          
            if ($motorItem->relationLoaded('hardcase')) {
                $hardcase = $motorItem->hardcase;
                $hardcase->update([
                    'status' => $status,
                    'plan_code' => $motorItem->plan_code,
                ]);
            }
        });
        static::deleting(function (MotorItem $motorItem) {
            $motorItem->load('general','hardcase');
            foreach ($motorItem->general as $generalItem) {
                $status = ($motorItem->status === 'Out Of Service') ? "Ready For Rent" : (($generalItem->status === 'Scrab') ? 'Scrab' : 'In Rental');
                $generalItem->update([
                    'status' => $status,
                ]);
            }
            if ($motorItem->relationLoaded('hardcase')) {
                $hardcase = $motorItem->hardcase;
                $status = ($motorItem->status === 'Out Of Service') ? "Ready For Rent" : (($hardcase->status === 'Scrab') ? 'Scrab' : 'In Rental');
                $hardcase->update([
                    'status' => $status,
                ]);
            }
            $motorItem->general()->detach();
            $motorItem->hardcase()->detach();

        });
    }
}
