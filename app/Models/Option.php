<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'option_text',
    ];

    //! Relationship: One option belongs to one question
    public function question() {
        return $this->belongsTo(Question::class);
    }

    //! Relationship: One option has many answers
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
