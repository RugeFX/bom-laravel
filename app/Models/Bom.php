<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    use HasFactory;

    protected $fillable = [
        'bom_code',
        'item_code',
        'quantity'
    ];

    public function material(){
        return $this->belongsToMany(Material::class, 'bom_material', 'bom_id', 'item_code')->withPivot('item_code');
    }
    public function helmetItem(){
        return $this->hasMany(HelmetItem::class,'bom_code','bom_code');
    }
    public function fakItem(){
        return $this->hasMany(FakItem::class,'bom_code','bom_code');
    }
    
}
