<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = "materials";
    protected $fillable = [
        'item_code'
    ];
    protected $primaryKey = 'item_code'; 

    public $keyType = 'string';

    public $incrementing = false;

    public function bom()
    {
        return $this->belongsToMany(Bom::class, 'bom_material', 'item_code', 'bom_id')->withPivot('item_code');
    }

    public function helmet()
    {
        return $this->hasOne(Helmet::class, 'item_code', 'item_code');
    }

    public function medicine()
    {
        return $this->hasOne(Medicine::class, 'item_code', 'item_code');
    }

    public function general()
    {
        return $this->hasOne(General::class, 'item_code', 'item_code');
    }

    public function motor()
    {
        return $this->hasOne(Motor::class, 'item_code', 'item_code');
    }

    public function hardcase()
    {
        return $this->hasOne(Hardcase::class, 'item_code', 'item_code');
    }

    public static function booted(): void
    {
        static::deleting(function (Material $model) {
            $relations = ['bom', 'helmet', 'medicine', 'general', 'hardcase'];

            foreach ($relations as $relation) {
                $relatedModel = $model->$relation;

                if ($relatedModel instanceof \Illuminate\Database\Eloquent\Collection) {
                    // If it's a collection, delete each related model
                    $relatedModel->each(function ($item) {
                        $item->delete();
                    });
                } elseif ($relatedModel instanceof \Illuminate\Database\Eloquent\Model) {
                    // If it's a single model, delete it
                    $relatedModel->delete();
                }
            }
        });
    }
}
