<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelmetItem extends Model
{
    use HasFactory;
    protected $table = "helmetItems";
    protected $fillable = [
        'code',
        'bom_code',
        'name',
    ];

    public function bom(){
        return $this->belongsTo(Bom::class,'bom_code','bom_code');
    }
    public function reservation(){
        return $this->belongsToMany(Helmet::class,'reservations_helmetItem','helmet_code','code')->withPivot('helmet_code');
    }
}