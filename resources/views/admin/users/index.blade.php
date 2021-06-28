@extends('adminlte::page')

@section('content')
<div class="row">
	<div class="col-md-12">
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
				      	<a href="{{ route( 'admin.user.destroy', $user->id ) }}" class="btn btn-danger btn-sm">Delete</a>
				      	<a class="btn btn-success btn-sm">Active</a>
				      	<a class="btn btn-info btn-sm">Verified</a>
				      	<a class="btn btn-danger btn-sm">Approved User</a>
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
	</script>
@stop