<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = "motors_master";
    protected $fillable = [
        'name',
        'item_code',
        'quantity',
        'master_code'
        // 'color_id',
    ];

    public function master()
    {
        return $this->belongsTo(Master::class, "master_code", "master_code");
    }

    // public function color()
    // {
    //     return $this->belongsTo(Color::class);
    // }

    public function material()
    {
        return $this->belongsTo(Material::class, "item_code", "item_code");
    }

    public static function booted(): void
    {
        static::created(
            fn (General $model) =>
            $model->material()->create([
                "item_code" => $model->item_code
            ])
        );

        static::deleted(
            fn (General $model) => $model->material()->delete()
        );
    }
}
