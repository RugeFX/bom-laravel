<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menugroup extends Model
{
    use HasFactory;
    protected $table = 'menugroups';
    protected $fillable=[
        'code',
        'name'
    ];
    public function menuitem()
    {
        return $this->hasMany(Menuitem::class,"menugroup_code","code");
    }
}
