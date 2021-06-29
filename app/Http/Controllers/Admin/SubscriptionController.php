<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions= Subscription::all();
        return view('admin.subscriptions.index',compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                
            ],[

                'name.required' => ' The Subscription name field is required.',
                'price.required' => ' The Subscription price field is required.',
                'description.required' => ' The Subscription description field is required.',
              ]);

            $validator->validate();
  

            $subscription = Subscription::create([
                 'name' => $request->input('name'),
                 'price' => $request->input('price'),
                 'description' => $request->input('description')
                 
             ]);
           
 
             if($subscription !=="") {
                 return redirect()->route('subscriptions.index')
                 ->with('success' , 'Subscription created successfully');
             }
         
             return back()->withInput()->with('errors', 'Error creating new Subscription');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $subscription = Subscription::find($id);

        return view('admin.subscriptions.show', ['subscription'=>$subscription]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscription = Subscription::find($id);
        return view('admin.subscriptions.edit', ['subscription'=>$subscription]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                
            ],[

                'name.required' => ' The Subscription name field is required.',
                'price.required' => ' The Subscription price field is required.',
                'description.required' => ' The Subscription description field is required.',
              ]);

            $validator->validate();


        $subscription = Subscription::findOrFail($id);
        $subscription->name = $request->get('name');
        $subscription->price = $request->get('price');
        $subscription->description = $request->get('description');
        $subscription->save();
     
           return redirect()->route('subscriptions.index')
           ->with('success' , 'Subscription updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
       $subscription->delete();
    
        return redirect()->route('subscriptions.index')
                        ->with('success','Subscription deleted successfully');
    }
}
