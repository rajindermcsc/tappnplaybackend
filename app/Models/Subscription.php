<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'SubscriptionName',
        'Subscriptionprice',
        'Subscriptiondescription'
    ];


}
