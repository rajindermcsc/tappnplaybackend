@extends('adminlte::page')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8 mt-5">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Subscription</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form action="{{route('subscriptions.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Subscription Name">
                    @error('name')
                      <p class="error">{{ $message }}</p>
                    @enderror     
                  </div>
                  <div class="form-group">
                    <label for="link">Price:</label>
                    <input type="link" class="form-control" name="price" placeholder="Enter Subscription Price">
                    @error('price')
                      <p class="error">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" placeholder="Enter Subscription Description" class="form-control"></textarea>
                    @error('description')
                      <p class="error">{{ $message }}</p>
                    @enderror
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