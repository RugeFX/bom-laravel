<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $table = "medicines_master";
    protected $fillable = [
        'name',
        'item_code',
        'master_code',
        'quantity'
    ];

    public function master()
    {
        return $this->belongsTo(Master::class, "master_code", "master_code");
    }

    public function material()
    {
        return $this->belongsTo(Material::class, "item_code", "item_code");
    }

    public static function booted(): void
    {
        static::created(
            fn (Medicine $model) =>
            $model->material()->create([
                "item_code" => $model->item_code
            ])
        );

        static::deleted(
            fn (Medicine $model) => $model->material()->delete()
        );
    }
}
