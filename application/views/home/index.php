<div class="carousel carousel-fade slide" id="home-slide" data-ride="carousel">

	<ol class="carousel-indicators">
		<li data-target="#home-slide" data-slide-to="0" class="active"></li>
		<li data-target="#home-slide" data-slide-to="1"></li>
		<li data-target="#home-slide" data-slide-to="2"></li>
	</ol>

	<div class="carousel-inner">

		<div class="carousel-item active">
			<img class="image-slider home-image" src="<?= base_url('assets/images/homepage/img1.jpg') ?>">
			<div class="carousel-caption">
				<div class="text-left text-light">
					<h1>Welcome To ServeHealth!</h1>
					<h4>The medical reservation service!</h4>
				</div>
			</div>
		</div>

		<div class="carousel-item">
			<img class="image-slider home-image" src="<?= base_url('assets/images/homepage/img2.jpg') ?>">
			<div class="carousel-caption">
				<div class="text-left text-light">
					<h1>Improves your medical quality!</h1>
					<h4>ServeHealth provides the service to help you doing checkup better!</h4>
				</div>
			</div>
		</div>

		<div class="carousel-item">
			<img class="image-slider home-image" src="<?= base_url('assets/images/homepage/img3.jpg') ?>">
			<div class="carousel-caption">
				<div class="text-left text-light">
					<?php if ($this->session->userdata('login')) : ?>
						<h1>Make Reservation?</h1>
						<h4><a href="<?= site_url('dashboard') ?>" class="btn btn-outline-light">Dashboard</a></h4>
					<?php else : ?>
						<h1>Don't have an account?</h1>
						<h4><a href="#" class="btn btn-outline-light" id="home-register">Register!</a></h4>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<a href="#home-slide" role="button" data-slide="prev" class="carousel-control-prev">
			<span class="carousel-control-prev-icon"></span>
			<span class="sr-only">Previous</span>
		</a>

		<a href="#home-slide" role="button" data-slide="next" class="carousel-control-next">
			<span class="carousel-control-next-icon"></span>
			<span class="sr-only">Next</span>
		</a>

	</div>
</div>

<div class="container mt-lg-3">
	<h4 class="text-center">Lets see what they said about ServeHealth!</h4>
	<hr>
	<div class="row">
		<div class="col-lg-3 mx-auto">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Rizky Muhammad</h5>
					<h6 class="card-subtitle mb-2 text-muted">Absolutely Responsive!</h6>
					<p class="card-text">This website really helped me communicate with my doctor!.</p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mx-auto">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Putra Abdullah</h5>
					<h6 class="card-subtitle mb-2 text-muted">Fast!</h6>
					<p class="card-text">Truly helped me when I need to reserve ASAP! Thank You ServeHealth!</p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mx-auto">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Anastasia Putri</h5>
					<h6 class="card-subtitle mb-2 text-muted">Live Saver!</h6>
					<p class="card-text">Absoulutely useful when I need to do checkups! Really awesome work!</p>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {
		$('#home-register').click((e) => {
			$('#register').click();
		});
	});
</script>
