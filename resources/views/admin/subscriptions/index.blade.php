@extends('adminlte::page')

@section('content')
<div class="row">
	<div class="col-md-12">
		@include('message')
	</div>
	<div class="col-md-6">
		<h4>Subscription Listing</h4>
	</div>
	<div class="col-md-6">
		<a href="{{ route('subscriptions.create') }}" class="btn btn-primary float-right">Add New Subscription</a>
	</div>

	<div class="col-md-12 mt-2">
	    <div class="card card-primary p-3">
	      	
			<table class="table table-bordered datatable-listing">
			  <thead>
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Price</th>
			      <th scope="col">Description</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead> 
			  <tbody>
			  	@if( $subscriptions->isNotEmpty() )
				  	@foreach($subscriptions as $subscription)
				    <tr>
				      <td>{{ $subscription->name }}</td>
				      <td>{{ $subscription->price }}</td>
				      <td>{{ $subscription->description }}</td>
				      <td>
				      	<a href="{{route('subscriptions.edit', $subscription->id)}}" class="btn btn-default btn-sm">Edit</a>
				      	<a href="{{route('subscriptions.show', $subscription->id)}}" class="btn btn-success btn-sm">Show</a>
				      	<form action="{{ route( 'subscriptions.destroy', $subscription->id ) }}" method="post">
				      		@csrf
                    @method('DELETE')
				      	<input class="btn btn-danger btn-sm" type="submit" value="delete">
				      	</form>
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