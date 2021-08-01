<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'UserId',
        'PaymentTransactionId',
        'SubscriptionTypeId',
        'SubscribedFrom',
        'Amount',
        'SubscriptionStartDate',
        'SubscriptionEndDate',
        'SubscriptionUpdatedDate',
        'IsActive',
        'IsDeleted',
    ];


    public function user() {
        return $this->belongsTo(User::class,'UserId','id');
    }
}
