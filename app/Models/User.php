<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Block;
use App\Models\Setting;
use App\Models\UserDevice;
use App\Models\Subscription;
use App\Models\Photo;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'JoiningAs',
        'ProfilePicture',
        'ProfilePictureThumbnail',
        'QuickBloxId',
        'LastLoginAt',
        'Location',
        'Latitude',
        'Longitude',
        'Timezone',
        'IsActive',
        'IsSystemAdmin',
        'IsProfileVerified',
        'IsUserAccountApproved',
        'IsProfileVisible',
        'QRCodeImage',
        'QRCodeImageThumbnail',
        'ProfileVisibilityEnabled',
        'LocationVisibilityEnabled',
        'TransactionId',
        'Subscribedfrom',
        'SubscriptionTypeId',
        'Amount',
        'SubscriptionStartDate',
        'SubscriptionEndDate',
        'IsSubscriptionExpired',
        'SubscriptionUpdatedOn',
        'VerificationCode',
        'terms_check'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ProfileVisibilityEnabled' => 'boolean',
        'LocationVisibilityEnabled' => 'boolean',
        'IsProfileVerified' => 'boolean',
        'IsUserAccountApproved' => 'boolean',
        'IsProfileVisible' => 'boolean',
        'IsActive' => 'boolean',
        'IsSystemAdmin' => 'boolean',
        'terms_check' => 'boolean'

    ];


   /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // public function getNameAttribute($value)
    // {
    //     return $this->Name; 
    // }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->Email;
    }



    // public function getEmailAttribute($value)
    // {
    //     return $this->Email; 
    // }



    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }    

    public function role(){
        return $this->hasOne(Role::class, 'id', 'role_id');
    }


    public function settings() {
        return $this->hasMany(Setting::class,'UserId','id');
    }

    public function devices() {
        return $this->hasOne(UserDevice::class,'UserId','id');
    }

    public function subscriptions() {
        return $this->hasOne(UserSubscription::class, 'UserId', 'id');
    }

    public function photos() {
        return $this->hasMany(Photo::class,'UserId','id');
    }

    public function privatephotos() {
        return $this->hasMany(Photo::class, 'UserId','id')->where('IsPrivatePhoto','=', 1);;
    }
 


    public function preferences(){
        return $this->belongsToMany('App\Models\Preference','user_preference','UserId', 'PreferenceId');
    }


    public function friends(){
        return $this->hasMany(Friend::class,'UserId','id');
    }



    // public function received() {
    //     return $this->hasMany(Friend::class, 'FriendUserId', 'id');
    // }

    // public function sent() {
    //     return $this->hasMany(Friend::class,'UserId', 'id');
    // }
}
