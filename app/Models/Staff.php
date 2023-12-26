<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $fillable = [
        "code",
        "name",
        "urlImage",
        "role_code",
        "information",
    ];

    public function role(){
        return $this->belongsTo(Role::class,"role_code","code");
    }
    public function user(){
        return $this->hasOne(User::class,"staff_code","code");
    }
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function($staff){
    //         $staff->fleets()->delete();
    //         $staff->user()->delete();
    //         $staff->transaction()->delete();
    //     });
    // }
}
