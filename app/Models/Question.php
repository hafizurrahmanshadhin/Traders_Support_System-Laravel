<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category',
        'question_text',
        'type',
    ];

    //! Relationship: One question has many options
    public function options() {
        return $this->hasMany(Option::class);
    }

    //! Relationship: One question has many answers
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
