@if(session('error'))
<div class="container">
	<div class="alert alert-danger my-1">
			{{ session('error') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
		</div>
</div>		
@endif

@if(session('success'))
<div class="container">
	<div class="alert alert-success my-1">
			{{ session('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
		</div>
</div>		
@endif

@if(session('changed_success_alert'))
<script>
	var toastMixin = Swal.mixin({
	  toast: true,
	  icon: 'success',
	  title: 'General Title',
	  animation: false,
	  position: 'bottom-right',
	  showConfirmButton: false,
	  timer: 3000,
	  timerProgressBar: true,
	  didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	});
	toastMixin.fire({
	  animation: true,
	  title: 'Thay đổi thành công!',
	}); 
</script>
@endif
@if(session('changed_error_alert'))
<script>
	var toastMixin = Swal.mixin({
	  toast: true,
	  icon: 'error',
	  title: 'General Title',
	  animation: false,
	  position: 'bottom-right',
	  showConfirmButton: false,
	  timer: 3000,
	  timerProgressBar: true,
	  didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	});
	toastMixin.fire({
	  animation: true,
	  title: "Error! Try Again",
	}); 
</script>
@endif

@if(session('added_inspector_success_alert'))
<script>
	var toastMixin = Swal.mixin({
	  toast: true,
	  icon: 'success',
	  title: 'General Title',
	  animation: false,
	  position: 'bottom-right',
	  showConfirmButton: false,
	  timer: 3000,
	  timerProgressBar: true,
	  didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	});
	toastMixin.fire({
	  animation: true,
	  title: 'Thêm hỗ trợ viên thành công!',
	}); 
</script>
@endif