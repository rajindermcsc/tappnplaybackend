<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['UserId','BlockedUserQuickBloxId','BlockedUserId'];

    
  

}
