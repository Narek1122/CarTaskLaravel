<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'car_models';

    protected $fillable = [
        'model',
        'brand_id'
    ];

    public function brands(){
        return $this->belongsTo(CarBrand::class,'brand_id');
    }
}
