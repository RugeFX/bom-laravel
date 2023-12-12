<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = "material_master";
    protected $fillable = [
        'item_code'
    ];

    public function bom(){
        return $this->belongsToMany(Bom::class,'item_code','item_code')->withPivot('quantity');
    }

    public function helmet(){
        return $this->hasOne(Helmet::class,'item_code','item_code');
    }

    public function medicine(){
        return $this->hasOne(Medicine::class,'item_code','item_code');
    }

    public function general(){
        return $this->hasOne(General::class,'item_code','item_code');
    }
    
    public function hardcase(){
        return $this->hasOne(Hardcase::class,'item_code','item_code');
    }
}
