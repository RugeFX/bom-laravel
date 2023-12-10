<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_code',
        'master_id',
        'quantity'
    ];

    public function master(){
        return $this->belongsTo(Master::class);
    }
}
