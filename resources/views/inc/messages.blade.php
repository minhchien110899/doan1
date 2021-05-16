@if (session('error'))
    <div class="container">
        <div class="alert alert-danger my-1">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="container">
        <div class="alert alert-success my-1">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('changed_success_alert'))
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
@if (session('changed_error_alert'))
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

@if (session('added_inspector_success_alert'))
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

@if (session('elearning_error_alert'))
    <div class="container">
        <div class="alert alert-danger my-1">
            {{ session('elearning_error_alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('success_init_personalize'))
<div id="success-personalize" class="w3-modal">
	<div class="w3-modal-content w3-animate-left w3-round py-3">
		<div class="w3-container px-0">
				<span onclick="document.getElementById('success-personalize').style.display='none'" class="w3-button w3-display-topright" style="font-size: 25px;line-height: 24px;z-index:1;">&times;</span>
				<div class="container px-0">
					<div class="d-flex justify-content-center">
						<img src="/images/success-confetti.gif" width="300px">
					</div>
					<div class="text-center">
						<h4>Chúc mừng bạn đã tạo thành công lộ trình cho riêng mình !</h4>
					</div>
				</div>
				<footer class="w3-container d-flex justify-content-center">
					<button class="w3-btn w3-round-large w3-medium btn-primary w3-padding-small mr-1" onclick="document.getElementById('success-personalize').style.display='none'">Xác nhận</button>   
				</footer>
		</div>
	</div>
</div>
<script>
	document.getElementById('success-personalize').style.display='block';	
</script>
    <?php 
        session_start();
        unset($_SESSION['success_init_personalize']);
    ?>
@endif
