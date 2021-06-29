@extends('adminlte::page')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8 mt-5">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header --> 
              <!-- form start -->
              <form action="{{route('admin.user.store')}}" method="post">
                @csrf
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
                    <input type="file" class="form-control" id="avatar" name="avatar">
                     @error('avatar')
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
          @stop