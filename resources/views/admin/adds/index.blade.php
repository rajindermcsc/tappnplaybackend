@extends('adminlte::page')

@section('content')
<div class="row">
	<div class="col-md-12">
		@include('message')
	</div>
	<div class="col-md-6">
		<h4>Advertisements Listing</h4>
	</div>
	<div class="col-md-6">
		<a href="{{ route('admin.adds.create') }}" class="btn btn-primary float-right">Add New Advertisement</a>
	</div>

	<div class="col-md-12 mt-2">
	    <div class="card card-primary p-3">
	      	
			<table class="table table-bordered datatable-listing">
			  <thead>
			    <tr>
			      <th scope="col">Title</th>
			      <th scope="col">Image</th>
			      <th scope="col">Description</th>
			      <th scope="col">Link</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead> 
			  <tbody>
			  	@if( $adds->isNotEmpty() )
				  	@foreach($adds as $add)
				    <tr>
				      <td>{{ $add->title }}</td>
				      <td>{{ $add->description }}</td>
				      <td>{{ $add->link }}</td>
				      <td>{{ $add->image }}</td>
				      <td>
				      	<a href="{{route('admin.adds.edit', $add->id)}}" class="btn btn-default btn-sm">Edit</a>
				      	<a href="{{ route( 'admin.adds.destroy', $add->id ) }}" class="btn btn-danger btn-sm">Delete</a>
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