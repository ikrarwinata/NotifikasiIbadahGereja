<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jadwal Ibadah :: Login Page</title>
	<base href="<?php echo (base_url()) ?>">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="assets/plugins/flag-icon-css/css/flag-icon.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition lockscreen">
	<!-- Automatic element centering -->
	<div class="lockscreen-wrapper">
		<div class="lockscreen-logo">
			<a href="<?php echo (base_url('Welcome/index')) ?>">Login <b>Administrator</b></a>
		</div>
		<!-- User name -->
		<div class="lockscreen-name">Username</div>

		<?php if ($this->session->userdata('ci_login_flash_message') != NULL) : ?>
			<div class="alert text-center mb-1 mt-0 <?php echo $this->session->userdata('ci_login_flash_message_type') ?>" role="alert">
				<small><?php echo $this->session->userdata('ci_login_flash_message') ?></small>
			</div>
		<?php endif; ?>

		<!-- START LOCK SCREEN ITEM -->
		<div class="lockscreen-item">

			<!-- lockscreen credentials (contains the form) -->
			<form class="lockscreen-credentials" action="<?php echo (base_url('Welcome/login')) ?>" method="POST" style="margin-left: 8px;">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Username" name="jig_username" required maxlength="50" autofocus>

					<div class="input-group-append">
						<button type="submit" class="btn">
							<i class="fas fa-arrow-right text-muted"></i>
						</button>
					</div>
				</div>
			</form>
			<!-- /.lockscreen credentials -->
		</div>
		<!-- /.lockscreen-item -->
		<div class="help-block text-center">
			Silahkan masukan username anda untuk melanjutkan
		</div>
		<div class="lockscreen-footer text-center">
			<small>
				Copyright &copy; 2021 All rights reserved.<br>
				Template Design by <b><a href="https://adminlte.io" class="text-black">AdminLTE.io</a></b>
			</small>
		</div>
	</div>
	<!-- /.center -->

	<!-- jQuery -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>