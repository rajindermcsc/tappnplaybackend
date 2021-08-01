<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'SettingType',
        'SettingName',
        'SettingValue'
    ];

    protected $casts = [
    'SettingValue' => 'boolean',
 ];

public function user()
{
  return $this->belongsTo(User::class,'id');
}
    
}
