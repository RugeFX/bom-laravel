<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $table = "generals_master";
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

    public function material() {
        return $this->belongsTo(Material::class, "item_code", "item_code");
    }

    public static function booted(): void
    {
        static::created(fn (General $model) =>
            $model->material()->create([
                "item_code" => $model->item_code
            ])
        );

        static::deleted(fn (General $model) =>
            $model->material()->where("item_code", "=", $model->item_code)->delete()
        );
    }
}
