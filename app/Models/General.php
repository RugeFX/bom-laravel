<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_code',
        'quantity',
        'color_id',
        'master_id'
    ];

    public function master(){
        return $this->belongsTo(Master::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
