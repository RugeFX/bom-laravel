<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'bom_code',
        'name',
        'plan_code'
    ];
    protected $table = "fakItems";
    public function bom(){
        return $this->belongsTo(Bom::class,'bom_code','bom_code');
    }
    public function reservation(){
        return $this->belongsToMany(Helmet::class,'reservations_fakItem','fak_code','code')->withPivot('fak_code');
    }
    public function plan(){
        return $this->belongsTo(Plan::class,'plan_code','plan_code');
    }
}
