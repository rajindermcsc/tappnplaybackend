@extends('adminlte::page')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8 mt-5">
          @include('message');
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Advertiement</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form action="{{route('admin.adds.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter title">
                    @error('title')
                      <p class="error">{{ $message }}</p>
                    @enderror     
                  </div>
                  <div class="form-group">
                    <label for="link">Advertisement Link (URL):</label>
                    <input type="link" class="form-control" name="link" placeholder="Enter link">
                    @error('link')
                      <p class="error">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control"></textarea>
                    @error('description')
                      <p class="error">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="image">Advertisement Image:</label>
                    <input type="file" class="form-control" name="image" id="image" onchange="preview(this);">
                     @error('image')
                        <p class="error">{{ $message }}</p>
                     @enderror
                     <img id="preview" src="http://placehold.it/180" 
                      alt="preview image" class="preview" style="max-height: 100px;">
                  </div>
                  
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