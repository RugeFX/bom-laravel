<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralItem extends Model
{
    use HasFactory;
    protected $table = "generalItems";
    protected $primaryKey = 'code'; 

    public $keyType = 'string';

    public $incrementing = false;
    protected $fillable = [
        'code',
        'bom_code',
        'name',
        'plan_code',
        'status',
        'information',
    ];
    public function bom(){
        return $this->belongsTo(Bom::class,'bom_code','bom_code');
    }
    public function motorItems(){
        return $this->belongsToMany(MotorItem::class,'motorItem_generalItem','general_code','code');
    }
    public function plan(){
        return $this->belongsTo(Plan::class,'plan_code','plan_code');
    }

}
