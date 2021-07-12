@extends('adminlte::page')

@section('content')

<div class="row justify-content-center">
      <div class="col-md-12 col-12 mt-5">
      <div class="row">
      <div class="col-md-4 col-sm-6 col-12 5">
        <div class="info-box">
          
          <div class="info-box-content">
            <span class="info-box-text">Title</span>
            <span class="info-box-number">{{$preference->title}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
   

          <div class="info-box-content">
            <span class="info-box-text">Icon</span>
            <span class="info-box-number"> @if( !is_null($preference->icon))
              <img style="height:250px;width:250px;" src="{{URL::to('/')}}/preferences/{{$preference->icon }}" />
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



      
      <!-- /.col -->
    </div>
    </div>
    </div>
@stop