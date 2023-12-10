<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    use HasFactory;

    protected $fillable = [
        'Bom_code',
        'item_code',
        'quantity'
    ];

    public function material(){
        return $this->belongsToMany(Material::class,'item_code','item_code')->withPivot('quantity');
    }
}
