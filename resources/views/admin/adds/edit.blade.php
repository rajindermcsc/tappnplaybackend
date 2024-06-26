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
              <form action="{{route('admin.adds.update', $adds->id )}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{$adds->Title}}">
                    @error('title')
                      <p class="error">{{ $message }}</p>
                    @enderror     
                  </div>
                  <div class="form-group">
                    <label for="link">Advertisement Link (URL):</label>
                    <input type="link" class="form-control" name="link" placeholder="Enter link" value="{{$adds->AdertisementLink}}">
                    @error('link')
                      <p class="error">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control">{{$adds->Description}}</textarea>
                    @error('description')
                      <p class="error">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="image">Advertisement Image:</label>
                    <input type="file" class="form-control" name="image" id="image" onchange="previewpic(this);">
                    @error('image')
                      <p class="error">{{ $message }}</p>
                    @enderror
                    <img id="preview" src="{{asset('adds/'.$adds->AdvertisementImage)}}" 
                      alt="preview image" class="preview mt-3" style="max-height: 80px;" />
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