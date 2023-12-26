<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelmetItem extends Model
{
    use HasFactory;
    protected $table = "helmetItems";
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
    public function reservation(){
        return $this->belongsToMany(Helmet::class,'reservations_helmetItem','helmet_code','code')->withPivot('helmet_code');
    }
    public function plan(){
        return $this->belongsTo(Plan::class,'plan_code','plan_code');
    }
}
