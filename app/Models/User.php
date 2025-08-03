<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\sendPasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'terms_accepted' => 'boolean',
    ];

    protected $attributes = [
        'terms_accepted' => false,
    ];

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    //! Relationship: One user has many answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    //! This is a custom method to check if the user is subscribed
    public function isSubscribed()
    {
        return $this->membership()->exists();
    }

    //! Relationship: One user has many memberships
    public function membership()
    {
        return $this->hasOne(Membership::class)->where('end_date', '>', now());
    }

    public function boostTransaction()
    {
        return $this->hasMany(BoostTransaction::class);
    }

    /**
     * Get the identifier that will be stored in the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * User Email Verification
     * Return true if email is verified
     */
    public function sendEmailVerificationNotification()
    {
        $otp = rand(1000, 9999);
        $this->notify(new EmailVerificationNotification($otp));
        return $otp;
    }

    /**
     * User Email Verification
     * Return true if email is verified
     */
    public function PasswordResetNotification()
    {
        $otp = rand(1000, 9999);
        $this->notify(new sendPasswordResetNotification($otp));
        return $otp;
    }



    /**
     * One to many relationship
     * User Has Many Images
     */
    public function myImages()
    {
        return $this->hasMany(MyImages::class, 'user_id', 'id');
    }

    /**
     * Get My Connections
     * @return \Illuminate\Http\Response
     */
    public function myConnectionsForPro(){
        return $this->hasMany(MyConnect::class, 'connect_id','id');
    }


    // public function getAvatarAttribute($value)
    // {
    //     return $value ? url($value) : null;
    // }
}
