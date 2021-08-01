<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserDevice extends Model
{
    use HasFactory;


protected $fillable = [
        'UserId',
        'DeviceId',
        'DeviceType'
    ];


    public function user()
    {
      return $this->belongsTo(User::class,'UserId','id');
    }

}
