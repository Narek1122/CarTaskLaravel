<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskImages extends Model
{
    use HasFactory;

    protected $table = 'task_images';

    protected $fillable = [
        'picture',
        'task_id'
    ];
}
