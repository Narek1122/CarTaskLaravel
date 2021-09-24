<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'brand',
        'admin_id'
    ];

    public function brands(){
        return $this->belongsTo(User::class,'admin_id');
    }

    public function taskImages(){
        return $this->hasMany(TaskImages::class,'task_id');
    }
}
