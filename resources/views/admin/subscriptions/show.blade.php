@extends('adminlte::page')

@section('content')

<div class="row">
          <div class="col-md-4 col-sm-6 col-12 mt-5">
            <div class="info-box">
              
              <div class="info-box-content">
                <span class="info-box-text">Name</span>
                <span class="info-box-number">{{$subscription->name}}</span>
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
                <span class="info-box-number">{{$subscription->price}}</span>
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
                <span class="info-box-number">{{$subscription->description}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
        </div>

        @stop