<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FindingThePerfectMatche extends Model {
    use HasFactory, SoftDeletes;

    protected $table    = "finding_the_perfect_matches";
    protected $fillable = ['image', 'title', 'status'];
}
