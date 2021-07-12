@extends('adminlte::page')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-12 mt-5">
		@include('message')


	</div>
	<div class="col-md-6">
		<h4>Users Listing</h4>
	</div>
	<div class="col-md-6">
		<a href="{{ route('admin.user.create') }}" class="btn btn-primary float-right">Add New User</a>
	</div>

	<div class="col-md-12 mt-2">
	    <div class="card card-primary p-3">
	      	
			<table class="table table-bordered datatable-listing">
			  <thead>
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">Role</th>
			      <th scope="col">Joining as</th>
			      <th scope="col">Last login at</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead> 
			  <tbody>
			  	@if( $users->isNotEmpty() )
				  	@foreach($users as $user)
				    <tr>
				      <td>{{ $user->name }}</td>
				      <td>{{ $user->email }}</td>
				      <td>{{ $user->role->name }}</td>
				      <td>{{ ucfirst($user->gender) }}</td>
				      <td>{{ !empty($user->last_login_at)?$user->last_login_at:'N/A' }}</td>
				      <td>
				      	<a href="{{route('admin.user.show', $user->id)}}" class="btn btn-default btn-sm">View</a>
				      	<a href="{{ route( 'admin.user.destroy', $user->id ) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to Delete?');">Delete</a>
				      	<a class="btn btn-sm isactive-btn {{ ($user->IsActive)?'btn-success':'btn-danger' }}" data-id= "{{$user->id}}" data-status="{{$user->IsActive}}" onclick="return confirm('Are you sure?');">
				      		@if($user->IsActive)
				      			Active
				      		@else
				      			Inactive
				      		@endif
				      		</a>

				      	<a class="btn  btn-sm  isverified-btn  {{ ($user->IsProfileVerified)?' btn-success':'btn-danger' }}" data-id="{{$user->id}}" data-status="{{$user->IsProfileVerified}}"onclick="return confirm('Are you sure?');">
				      	@if($user->IsProfileVerified)
				      			Verified
				      		@else
				      			UnVerified
				      		@endif
				      </a>
				      	<a class="btn  btn-sm isapprove-btn {{ ($user->IsApproved)?' btn-success':'btn-danger' }}" data-id="{{$user->id}}" data-status="{{$user->IsApproved}}"onclick="return confirm('Are you sure ?');">
				      	@if($user->IsApproved)
				      			Approved 
				      		@else
				      			UnApproved 
				      		@endif</a>
				      </td>
				    </tr>
				    @endforeach
				@else
					<tr>
						<td colspan="4">N/A</td>
					</tr>
				@endif
			  </tbody>
			</table>
		</div>
	</div>
</div>
@stop
 
@section('js')
	<script type="text/javascript">
	   	$('.datatable-listing').DataTable();

		$(".isactive-btn").click(function(){   
			var ele = $(this);
			var user_id = $(this).data('id');
			var IsActive = $(this).data('status');
			$.ajax({
		         url: "{{route('admin.user.active')}}",
		 	   type:"POST",
			   data:{"_token": "{{ csrf_token() }}", user_id: user_id, IsActive:IsActive},
                 	   success:function(response){
                 	   	if(response.user.IsActive){
                 	   		ele.text('Active');
                 	   		ele.addClass('btn-success').removeClass('btn-danger');
                 	   		$('.msg-box .js-alert').show().find('.text-msg').html('User Active Succesfully!');
                 	   	}else{
                 	   		ele.text('Inactive');
                 	   		ele.addClass('btn-danger').removeClass('btn-success');
                 	   		$('.msg-box .js-alert').show().find('.text-msg').html('User Inactive Succesfully!');
                 	   	}
                     }
		    });
		});	



		$(".isverified-btn").click(function(){   
			var ele = $(this);
			var user_id = $(this).data('id');
			var IsProfileVerified = $(this).data('status');
			$.ajax({
		         url: "{{route('admin.user.verified')}}",
		 	   type:"POST",
			   data:{"_token": "{{ csrf_token() }}", user_id: user_id, IsProfileVerified:IsProfileVerified},
                 	   success:function(response){
                 	   	if(response.user.IsProfileVerified){
                 	   		ele.text('Verified');
                 	   		ele.addClass('btn-success').removeClass('btn-danger');
                 	   		$('.msg-box .js-alert').show().find('.text-msg').html('User Verified Succesfully!');
                 	   	}else{
                 	   		ele.text('UnVerified');
                 	   		ele.addClass('btn-danger').removeClass('btn-success');
                 	   		$('.msg-box .js-alert').show().find('.text-msg').html('User UnVerified Succesfully!');
                 	   	}
                     }
		    });
		});




		$(".isapprove-btn").click(function(){   
			var ele = $(this);
			var user_id = $(this).data('id');
			var IsApproved = $(this).data('status');
			$.ajax({
		         url: "{{route('admin.user.approved')}}",
		 	   type:"POST",
			   data:{"_token": "{{ csrf_token() }}", user_id: user_id, IsApproved:IsApproved},
                 	   success:function(response){
                 	   	if(response.user.IsApproved){
                 	   		ele.text('Approved');
                 	   		ele.addClass('btn-success').removeClass('btn-danger');
                 	   		$('.msg-box .js-alert').show().find('.text-msg').html('User Approved Succesfully!');
                 	   	}else{
                 	   		ele.text('UnApproved');
                 	   		ele.addClass('btn-danger').removeClass('btn-success');
                 	   		$('.msg-box .js-alert').show().find('.text-msg').html('User UnApproved Succesfully!');
                 	   	}
                     }
		    });
		});		








	</script>
@stop