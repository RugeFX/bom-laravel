<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    use HasFactory;
    protected $table = 'menuitems';
    protected $fillable=[
        "code",
        'name',
        'url',
        'menugroup_code*',
    ];
    public function menugroup()
    {
        return $this->belongsTo(Menugroup::class,"menugroup_code","code");
    }
    public function privilege()
    {
        return $this->hasMany(Privilege::class,"menuitem_code","code");
    }
}
