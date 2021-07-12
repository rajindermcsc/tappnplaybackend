<div class="col-md-12 msg-box">

<div class="alert dark alert-icon alert-success alert-dismissible alertDismissible js-alert" role="alert" style="display:none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">×</span>
  </button>
  <i class="icon wb-check" aria-hidden="true"></i> 
  <strong class="text-msg"></strong>
</div>

@if( session('success') )
	<div class="alert dark alert-icon alert-success alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i> 
	  {{ session('success') }}
	</div>
@endif


@if( session('error') )
	<div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i> 
	  {{ session('error') }}
	</div>
@endif
</div>