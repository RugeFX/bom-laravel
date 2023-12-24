<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_code',
        'menuitem_code',
        'view',
        'add',
        'edit',
        'delete',
        'import',
        'export',
    ];

    public function menuitem()
    {
        return $this->belongsTo(Menuitem::class,"code","menuitem_code");
    }

    public function role()
    {
        return $this->belongsTo(Role::class,"code","role_code");
    }
}
