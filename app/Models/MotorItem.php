<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'bom_code',
        'name',
    ];

    public function bom(){
        return $this->belongsTo(Bom::class,'bom_code','bom_code');
    }
    public function reservation(){
        return $this->belongsToMany(Helmet::class,'reservations_motorItem','motor_code','code')->withPivot('motor_code');
    }
}
