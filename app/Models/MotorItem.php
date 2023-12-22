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
            $motorItem->load('general');
            $code = $motorItem->general->pluck('code');
            foreach($code as $c){
                $generalItem = GeneralItem::where('code', $c)->first();
                $generalItem->update(['plan_code' => $motorItem->plan_code]);
            }
            $hardcase_code = $motorItem->hardcase_code;
            $hardcaseItem = HardcaseItem::where('code', $hardcase_code)->first();
            $hardcaseItem->update(['plan_code' => $motorItem->plan_code]);
        });
        static::deleting(function (MotorItem $motorItem) {
            $motorItem->general()->detach();
        });
    }
}
