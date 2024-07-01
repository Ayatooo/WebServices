<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'price',
        'car_model_id',
        'user_id',
    ];

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
