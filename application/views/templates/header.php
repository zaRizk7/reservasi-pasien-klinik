<nav class="navbar navbar-light fixed-top navbar-expand-lg bg-light">
	<div class="container">

		<a class="navbar-brand" href="#"><i class="fas fa-clinic-medical mr-2"></i>ServeHealth</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="#">Announcement</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Register</a>
				</li>
			</ul>
			<?php if ($this->session->userdata('username')) : ?>
				<form class="form-inline" method="POST" action="<?= site_url('auth/logout') ?>">
					<div class="nav-form bg-dark">
						<span class="logged-in">Welcome <?= $this->session->userdata('username') ?></span>
						<button class="btn btn-outline-light" type="submit">Logout</button>
					</div>
				</form>
			<?php else : ?>
				<form class="form-inline" method="POST" action="<?= site_url('auth/login') ?>">
					<div class="nav-form bg-dark">
						<input type="text" name="username" id="username-field" class="form-control" placeholder="Username">
						<input type="password" name="password" id="password-field" class="form-control" placeholder="Password">
						<button class="btn btn-outline-light" type="submit">Login</button>
					</div>
				</form>
			<?php endif; ?>
		</div>

	</div>
</nav>
