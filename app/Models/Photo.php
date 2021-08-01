<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['UserId','Standard','Thumbnail','IsPrivatePhoto'];


public function user()
{
  return $this->belongsTo(User::class,'UserId','id');
}

}
