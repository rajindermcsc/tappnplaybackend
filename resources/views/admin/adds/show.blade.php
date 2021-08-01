@extends('adminlte::page')

@section('content')

<div class="row justify-content-center">
          <div class="col-md-4 col-sm-6 col-12 mt-5">
            <div class="info-box">
              
              <div class="info-box-content">
                <span class="info-box-text">Name</span>
                <span class="info-box-number">{{$user->Name}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
       

              <div class="info-box-content">
                <span class="info-box-text">Email</span>
                <span class="info-box-number">{{$user->Email}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
     
              <div class="info-box-content">
                <span class="info-box-text">Gender</span>
                <span class="info-box-number">{{$user->JoiningAs}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
  

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

        @stop