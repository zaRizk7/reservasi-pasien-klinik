<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php $this->load->view('templates/stylesheets'); ?>
	<link rel="shortcut icon" href="<?= base_url('assets/ico/favicon.ico') ?>" type="image/x-icon">
	<title><?= $title ?></title>
</head>

<body>
	<?php $this->load->view('templates/header'); ?>
	<div class="container">
		<?php $this->load->view($page); ?>
	</div>
	<?php $this->load->view('templates/footer'); ?>
	<?php $this->load->view('templates/scripts'); ?>
</body>

</html>
