<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Validator;

class SubscriptionController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function index()
    {

        $subscriptions= Subscription::all();

         return response()->json(['data'=>$subscriptions,'StatusCode'=> 200, 'Message'=> 'Subscriptions Listed successfully','user' =>'']);

        
    }




    public function updateSubscription(Request $request){

        if(Auth::check()){
             $insertdata = [
                'UserId'=> $request->UserId,
                'PaymentTransactionId' => $request->TransactionId,
                'SubscriptionTypeId'  => $request->SubscriptionTypeId,
                'Amount' => $request->Amount,
                'SubscribedFrom' => $request->SubscribedFrom,
                'SubscriptionStartDate' => $request->SubscriptionStartDate,
                'SubscriptionEndDate' => $request->SubscriptionEndDate
            ];

            $subscriptionexist = UserSubscription::where('UserId', $request->UserId)->first();

            if( !empty($subscriptionexist->id) ){
                 $updatedata = [
                    'PaymentTransactionId' => $request->TransactionId,
                    'SubscriptionTypeId'  => $request->SubscriptionTypeId,
                    'Amount' => $request->Amount,
                    'SubscribedFrom' => $request->SubscribedFrom,
                    'SubscriptionStartDate' => $request->SubscriptionStartDate,
                    'SubscriptionEndDate' => $request->SubscriptionEndDate
                ];
                $update = UserSubscription::where('id', $subscriptionexist->id)->update($updatedata);
            }else{
                $update = UserSubscription::create($insertdata);
            }

            $user = User::where('id', $request->UserId )->first();
            return response()->json([
                'StatusCode' => 200,
                'Message' => 'success',
                'User' => $user
            ]);
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 400);
        }



    }
    

}
