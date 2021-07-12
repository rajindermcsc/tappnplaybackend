<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'icon'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User','user_preference','user_id', 'preference_id');
    }


    
}
