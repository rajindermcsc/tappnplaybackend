<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = ['UserId','FriendUserId','Status','IsActive','CreatedByUserId'];


    public function user() {
        return $this->hasOne(User::class,'id','FriendUserId');
    }


    public function received() {
        return $this->hasMany(User::class,'id','FriendUserId');
    }

    public function sent() {
        return $this->hasMany(User::class,'id','UserId');
    }

}   
 