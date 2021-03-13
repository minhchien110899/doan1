@if(session('error'))
<div class="container">
	<div class="alert alert-danger">
			{{ session('error') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
		</div>
</div>		
@endif

@if(session('success'))
<div class="container">
	<div class="alert alert-success">
			{{ session('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
		</div>
</div>		
@endif