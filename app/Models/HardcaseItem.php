<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardcaseItem extends Model
{
    use HasFactory;
    protected $table = "hardcaseItems";
    protected $primaryKey = 'code'; 
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'code',
        'bom_code',
        'name',
        'plan_code',
        'monorack_code',
        'status',
        'information',
    ];
    
    public function bom(){
        return $this->belongsTo(Bom::class,'bom_code','bom_code');
    }
    public function reservation(){
        return $this->belongsToMany(Helmet::class,'reservations_motorItem','motor_code','code')->withPivot('motor_code');
    }
    public function plan(){
        return $this->belongsTo(Plan::class,'plan_code','plan_code');
    }
    public function motorItem(){
        return $this->hasOne(MotorItem::class,'hardcase_code','code');
    }
}
