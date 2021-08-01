@extends('adminlte::page')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Preferences</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form action="{{route('preferences.update',$preference->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                   @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{$preference->Title}}"name="title" placeholder="Enter Icon name">
                     @error('title')
                    <p class="error">{{ $message }}</p>
                     @enderror     
                  </div>
                 
                   
                  

                  <div class="form-group">
                    <label for="avatar">Icon</label>
                    <input type="file" class="form-control" id="avatar" name="icon">
                     @error('icon')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                  <img id="preview" src="{{URL::to('/')}}/preferences/{{$preference->icon}}" 
                      alt="preview image" style="max-height: 250px;">
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

           <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 
            <script type="text/javascript">
      
              $(document).ready(function (e) {
 
   
              $('#avatar').change(function(){
            
                   let reader = new FileReader();
 
                       reader.onload = (e) => { 
 
                     $('#preview').attr('src', e.target.result); 
                                             }
 
                     reader.readAsDataURL(this.files[0]); 
   
                         });
   
                        });
 
              </script>

          @stop