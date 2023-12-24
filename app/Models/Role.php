<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "code"
    ];
    public function staff(){
        return $this->hasMany(Staff::class,"role_code","code");
    }
    public function privilage()
    {
        return $this->hasMany(Privilege::class,"role_code","code");
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function($position){
    //         $position->staff()->delete();
    //     });
    // }
}
