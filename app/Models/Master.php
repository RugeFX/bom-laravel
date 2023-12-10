<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function bom(){
        return $this->belongsToMany(Bom::class);
    }

    public function size(){
        return $this->hasMany(Size::class);
    }

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
