<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Adt extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'price'
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {

            $model->slug = Str::slug(mb_substr($model->title, 0, 40) . '-' . $model->id);
            $model->save();
        });
    }
}
