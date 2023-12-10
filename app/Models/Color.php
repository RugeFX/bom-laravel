<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function helmet(){
        return $this->hasMany(Helmet::class);
    }

    public function medicine(){
        return $this->hasMany(Medicine::class);
    }

    public function general(){
        return $this->hasMany(General::class);
    }
    
    public function hardcase(){
        return $this->hasMany(Hardcase::class);
    }
}
