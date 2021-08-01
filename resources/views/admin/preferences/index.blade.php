@extends('adminlte::page')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-12 mt-5">
		@include('message')
	</div>
	<div class="col-md-6">
		<h4>Preference Listing</h4>
	</div>
	<div class="col-md-6">
		<a href="{{ route('preferences.create') }}" class="btn btn-primary float-right">Add New Preference</a>
	</div>

	<div class="col-md-12 mt-2">
	    <div class="card card-primary p-3">
	      	
			<table class="table table-bordered datatable-listing">
			  <thead>
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Icon</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead> 
			  <tbody>
			  	@if( $preferences->isNotEmpty() )
				  	@foreach($preferences as $preference)
				    <tr>
				      <td>{{ $preference->Title }}</td>
				      <td><img style="width:50px;" src="{{URL::to('/')}}/preferences/{{ $preference->icon }}" /></td>
				      <td>
				      	<a href="{{route('preferences.edit', $preference->id)}}" class="btn btn-default btn-sm">Edit</a>
				      	<a href="{{route('preferences.show', $preference->id)}}" class="btn btn-default btn-sm">View</a>
						<a href="{{ route( 'preferences.destroy', $preference->id ) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to Delete?');">Delete</a>    
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