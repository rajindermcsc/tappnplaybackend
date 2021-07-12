<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'block_user_id'];

    
    public function blockusers(){
        return $this->belongsTo(User::class, 'block_user_id', 'id');
    }    

}
