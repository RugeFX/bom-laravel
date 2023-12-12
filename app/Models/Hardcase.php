<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardcase extends Model
{
    use HasFactory;

    protected $table = "hardcases_master";
    protected $fillable = [
        'name',
        'item_code',
        'quantity',
        'size_id',
        'color_id',
        'master_id'
    ];

    public function master(){
        return $this->belongsTo(Master::class,"master_code","master_code");
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }
    
    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function material() {
        return $this->belongsTo(Material::class, "item_code", "item_code");
    }

    public static function booted(): void
    {
        static::created(fn (Hardcase $model) =>
            $model->material()->create([
                "item_code" => $model->item_code
            ])
        );

        static::deleted(fn (Hardcase $model) =>
            $model->material()->where("item_code", "=", $model->item_code)->delete()
        );
    }
}
