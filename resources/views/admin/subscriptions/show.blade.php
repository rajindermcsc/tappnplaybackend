@extends('adminlte::page')

@section('content')

<div class="row justify-content-center">
      <div class="col-md-12 col-12 mt-5">
      <div class="row">
      <div class="col-md-4 col-sm-6 col-12 5">
        <div class="info-box">
          
          <div class="info-box-content">
            <span class="info-box-text">Name</span>
            <span class="info-box-number">{{$subscription->SubscriptionName}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
   

          <div class="info-box-content">
            <span class="info-box-text">Price</span>
            <span class="info-box-number">{{$subscription->Subscriptionprice}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
 
          <div class="info-box-content">
            <span class="info-box-text">Description</span>
            <span class="info-box-number">{{ $subscription->Subscriptiondescription }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
     
    </div>
    </div>
    </div>
@stop