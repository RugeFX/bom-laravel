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

    public function size(){
        return $this->hasMany(Size::class,"master_code","master_code");
    }

    public function helmet(){
        return $this->hasMany(Helmet::class,"master_code","master_code");
    }

    public function medicine(){
        return $this->hasMany(Medicine::class,"master_code","master_code");
    }

    public function general(){
        return $this->hasMany(General::class,"master_code","master_code");
    }

    public function hardcase(){
        return $this->hasMany(Hardcase::class,"master_code","master_code");
    }
}
