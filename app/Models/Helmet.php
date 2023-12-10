<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Helmet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_code',
        'quantity',
        'size_id',
        'color_id',
        'master_id'
    ];

    public function master(){
        return $this->belongsTo(Master::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
