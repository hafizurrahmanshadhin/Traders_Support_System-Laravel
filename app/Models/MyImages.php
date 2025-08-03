<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyImages extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'my_images';
}
