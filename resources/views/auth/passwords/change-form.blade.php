 @include('message')

<h4>Change Password</h4>
<p class="mb-5">Set a strong password to prevent unauthorised access to your account</p>
    <form method="POST" action="{{ route('change.password') }}" >
        @csrf 

        <div class="form-group mb-4">
            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" placeholder="Current Password" required />
            @if($errors->has('current_password'))
                <span class="error text-danger">{{ $errors->first('current_password') }}</span>
            @endif
        </div>

        <div class="form-group mb-4">
            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" placeholder="New Password" required />
            @if($errors->has('new_password'))
                <span class="error text-danger">{{ $errors->first('new_password') }}</span>
            @endif
        </div>

        <div class="form-group">
            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" placeholder="Confirm New Password" required>
             @if($errors->has('new_confirm_password'))
                <span class="error text-danger">{{ $errors->first('new_confirm_password') }}</span>
            @endif
        </div>



        <div class="form-group row mb-0">

            <div class="col-md-12">

                <button type="submit" class="btn btn-primary">

                    Update Password

                </button>

            </div>

        </div>

    </form>