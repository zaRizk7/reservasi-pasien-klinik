<nav class="navbar navbar-light fixed-top navbar-expand-lg bg-light">
	<div class="container">

		<a class="navbar-brand" href="#">ServeHealth</a>
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
					<button class="btn btn-outline-dark" type="submit">Logout</button>
				</form>
			<?php else : ?>
				<form class="form-inline" method="POST" action="<?= site_url('auth/login') ?>">
					<div class="nav-form mr-2">
						<input type="text" name="username" id="username-field" class="form-control" placeholder="Username">
						<input type="password" name="password" id="password-field" class="form-control" placeholder="Password">
					</div>
					<button class="btn btn-outline-dark" type="submit">Login</button>
				</form>
			<?php endif; ?>
		</div>

	</div>
</nav>
