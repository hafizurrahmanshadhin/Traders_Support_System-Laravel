<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model {
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function hasExceededProfileViewLimit() {
        return $this->profile_views_used >= $this->subscription->view_limit;
    }

    public function incrementProfileViewsUsed() {
        $this->increment('profile_views_used');
    }

    // Ensure timestamps are enabled (this is the default behavior)
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function subscription() {
        return $this->belongsTo(Subscription::class);
    }
}
