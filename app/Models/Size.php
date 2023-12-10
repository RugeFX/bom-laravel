<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'master_id'
    ];

    public function master(){
        return $this->belongsTo(Master::class);
    }
    public function hardcase(){
        return $this->hasMany(Hardcase::class);
    }
    public function helmet(){
        return $this->hasMany(Helmet::class);
    }
}
