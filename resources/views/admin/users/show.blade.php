@extends('adminlte::page')

@section('content')

<div class="row justify-content-center">
      <div class="col-md-12 col-12 mt-5">
      <div class="row">
      <div class="col-md-4 col-sm-6 col-12 5">
        <div class="info-box">
          
          <div class="info-box-content">
            <span class="info-box-text">Name</span>
            <span class="info-box-number">{{$user->name}}</span>
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
            <span class="info-box-number"> @if( !is_null($user->email))
              {{$user->email }}
              @else
              NA
              @endif
</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
 
          <div class="info-box-content">
            <span class="info-box-text">Joining As</span>
            <span class="info-box-number">
              @if( !is_null($user->gender))
              {{ ucfirst($user->gender) }}
              @else
              NA
              @endif

              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">


          <div class="info-box-content">
            <span class="info-box-text">Preference</span>
            <span class="info-box-number">@if( !is_null($user->preference))
              {{$user->preference}}
              @else
              NA
              @endif</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>


      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <div class="info-box-content">
            <span class="info-box-text">Location</span>
            <span class="info-box-number">
              @if( !is_null($user->location))
              {{$user->location}}
              @else
              NA
              @endif
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">


          <div class="info-box-content">
            <span class="info-box-text">Time Zone</span>
            <span class="info-box-number"> @if( !is_null($user->timezone))
              {{$user->timezone}}
              @else
              NA
              @endif</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>


      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">


          <div class="info-box-content">
            <span class="info-box-text">Longitude</span>
            <span class="info-box-number">
              @if( !is_null($user->longitude))
              {{$user->longitude}}
              @else
              NA
              @endif</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">


          <div class="info-box-content">
            <span class="info-box-text">Latitude</span>
            <span class="info-box-number">
              @if( !is_null($user->latitude))
              {{$user->latitude}}
              @else
              NA
              @endif</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>


      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">


          <div class="info-box-content">
            <span class="info-box-text">Is profile verified</span>
            <span class="info-box-number">
            @if( !is_null($user->IsProfileVerified))
              @if($user->IsProfileVerified =='0')
              No
              @else
              Yes
              @endif
              @else
              NA
            @endif
             </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>



      
      <!-- /.col -->
    </div>
    </div>
    </div>
@stop