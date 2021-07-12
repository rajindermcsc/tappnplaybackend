@extends('adminlte::page')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8 mt-5 mb-5">
  <!-- form start -->
              <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add User</h3>
              </div>
              <!-- /.card-header --> 
              
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                     @error('name')
                    <p class="error">{{ $message }}</p>
                     @enderror     
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                     @error('email')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                      <div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" name="gender" checked="" value="male">
                        <label for="radioPrimary1">Male
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="gender" value="female">
                        <label for="radioPrimary2">Female
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary3" name="gender" value="couple">
                        <label for="radioPrimary3">
                          Couple
                        </label>
                      </div>
                    </div>
                     @error('gender')
                      <p class="error">{{ $message }}</p>
                     @enderror
                  </div>
                   <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                     @error('location')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>
                   <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter latitude">
                     @error('latitude')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="longitude">longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter longitude">
                     @error('longitude')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="timezone">Timezone</label>
                    <input type="text" class="form-control" id="timezone" name="timezone" placeholder="Enter timezone">
                     @error('timezone')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                     @error('password')
                    <p class="error">{{ $message }}</p>
                     @enderror
                  </div>

                  <div class="form-group">
                    <label for="avatar">Profile Picture</label>
                    <input type="file" class="form-control preview" id="avatar" name="avatar" onchange="previewpic(this);">
                     @error('avatar')
                      <p class="error">{{ $message }}</p>
                     @enderror
                     <img id="preview" src="http://placehold.it/180" alt="preview image" class="preview mt-3" style="max-height: 80px;">
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->












                
            </div>  







            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Photos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Private Photos</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" >
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                      
                     <div class="form-group mb-4 col-md-6">
                      <div class="row">
                        <div class="filelist"></div>
                        <input type="file" name="photos[]" class="file-input item-img" style="display: none" multiple>
                        <div class="fileupload-btn d-flex align-items-center justify-content-center" style="width:100px;height:100px;background: #ccc;">
                          <i class="fa fa-plus" style="font-size: 20px;"></i>
                        </div>
                      </div>
                    </div>


                  </div>

                  <div class="tab-pane" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    <div class="form-group mb-4 col-md-6">
                      <div class="row">
                        <div class="filelist"></div>
                        <input type="file" name="private_photos[]" class="file-input item-img" style="display: none" multiple>
                        <div class="fileupload-btn d-flex align-items-center justify-content-center" style="width:100px;height:100px;background: #ccc;">
                          <i class="fa fa-plus" style="font-size: 20px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
              <!-- /.card -->


              
            </div>

            <div class="card-footer">

              <div class="form-group mb-4 col-md-6">
                  <input type="checkbox" name="terms_check" value="1">
                
                <label>Terms & Condition</label>
              </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

          </div>
        </div> 

          @stop

@section('js')
  <script type="text/javascript">
     $(document).ready(function (e) {

      $('.fileupload-btn').click(function () {
          $(this).parents('.form-group').find(".file-input").click();
      });

      $(".file-input").change(function (e) {
        var ele = $(this);
        var files = e.target.files;
        filesLength = files.length;

          for (var i = 0; i < filesLength; i++) {
            var f = files[i];
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;

              ele.parents('.form-group').find(".filelist").append('<span class="preview-file"><img class="imageThumb" src="'+e.target.result +'" title="' + file.name + '" width="100"/><br/><span class="remove"><i class="fa fa-times"></i></span></span>');
            });
            fileReader.readAsDataURL(f);
          }
      
      });


      $(document).on('click', ".remove", function(){
        $(this).parents(".preview-file").remove();
      });

  
  });
 

  </script>
@stop