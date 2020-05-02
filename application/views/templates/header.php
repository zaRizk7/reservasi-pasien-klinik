<?php if ($this->session->flashdata('success')) : ?>

	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong><?= $this->session->flashdata('success') ?></strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

<?php elseif ($this->session->flashdata('failure')) : ?>

	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong><?= $this->session->flashdata('failure') ?></strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>

<div class="navbar navbar-expand-lg fixed-top navbar-light bg-light" id="header">
	<a href="<?= site_url() ?>" class="navbar-brand"><i class="fas fa-hand-holding-medical"></i>ServeHealth</a>
	<button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-content">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar-content">

		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a href="<?= site_url() ?>" class="nav-link">Home</a></li>
			<li class="nav-item"><a href="<?= site_url('about') ?>" class="nav-link">About</a></li>
		</ul>

		<form action="" method="POST" class="form-inline" id="login-form">
			<?php if (!$this->session->userdata('login')) : ?>
				<div class="input-group">
					<input type="text" class="form-control" id="login-username" placeholder="Username">
					<input type="password" class="form-control" id="login-password" placeholder="Password">
					<div class="input-group-append">
						<button type="submit" class="btn btn-outline-dark" id="login-button">Login</button>
						<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#add-patient-form" id="#register">Register</button>
					</div>
				</div>
			<?php else : ?>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><?= $this->session->userdata('login')['username'] ?></span>
					</div>
					<div class="input-group-append">
						<a href="<?= site_url('dashboard') ?>" class="btn btn-outline-dark" id="dashboard">Dashboard</a>
						<button class="btn btn-outline-dark" id="logout-button">Logout</button>
					</div>
				</div>
			<?php endif; ?>
		</form>

	</div>

</div>

<?php if (!$this->session->userdata('login')) : ?>
	<?php $this->load->view('user/form', ['account_type' => 'patient']) ?>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
	$(() => {
		$('#login-button').click(e => {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('user/login') ?>',
				data: {
					username: $('#login-username').val(),
					password: $('#login-password').val()
				},
				success: (data) => {
					location.href = '<?= site_url() ?>';
				}
			});
		});
		$('#logout-button').click(e => {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('user/logout') ?>',
				success: (data) => {
					location.href = '<?= site_url() ?>';
				}
			});
		});
		setTimeout(() => {
			$('.alert').fadeOut();
		}, 3000);
	})
</script>
