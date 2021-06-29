@extends('adminlte::page')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Subscription</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form action="{{route('subscriptions.update',$subscription->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Subscription name" value="{{$subscription->name}}">
                     @error('name')
                    <p class="error">{{ $message }}</p>
                     @enderror     
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Subscription Price" value="{{$subscription->price}}">
                     @error('price')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" placeholder="Enter Subscription Description" class="form-control">{{$subscription->description}}</textarea>
                    @error('description')
                      <p class="error">{{ $message }}</p>
                    @enderror
                  </div>

                  
                  
              
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>  
          </div>
        </div>  
          @stop