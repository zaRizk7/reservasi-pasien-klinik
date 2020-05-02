<ul class="nav nav-pills" id="account-management-tab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="patient-account-tab" data-toggle="pill" href="#patient-account" role="tab" aria-controls="patient-account" aria-selected="true">Patient</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="doctor-account-tab" data-toggle="pill" href="#doctor-account" role="tab" aria-controls="doctor-account" aria-selected="false">Doctor</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="admin-account-tab" data-toggle="pill" href="#admin-account" role="tab" aria-controls="account" aria-selected="false">Admin</a>
	</li>
</ul>
<div class="tab-content" id="account-management-content">
	<div class="tab-pane fade show active" id="patient-account" role="tabpanel" aria-labelledby="#patient-account-tab">
		<div class="mt-lg-3">
			<button class="btn btn-outline-dark mb-3" data-toggle="modal" data-target="#add-patient-form"><i class="fas fa-user-plus"></i> Add Patient</button>
			<div id="patient-table-container"></div>
		</div>
	</div>
	<div class="tab-pane fade" id="doctor-account" role="tabpanel" aria-labelledby="#doctor-account-tab">
		<div class="mt-lg-3">
			<button class="btn btn-outline-dark mb-3" data-toggle="modal" data-target="#add-doctor-form"><i class="fas fa-user-md"></i> Add Doctor</button>
			<div id="doctor-table-container"></div>
		</div>
	</div>
	<div class="tab-pane fade" id="admin-account" role="tabpanel" aria-labelledby="#admin-account-tab">
		<div class="mt-lg-3">
			<button class="btn btn-outline-dark mb-3" data-toggle="modal" data-target="#add-admin-form"><i class="fas fa-user-shield"></i> Add Admin</button>
			<div id="admin-table-container"></div>
		</div>
	</div>
</div>

<?php $this->load->view('user/form', ['account_type' => 'patient']); ?>
<?php $this->load->view('user/form', ['account_type' => 'doctor']); ?>
<?php $this->load->view('user/form', ['account_type' => 'admin']); ?>
<script>
	$(() => {
		function loadPatientTable() {
			$('#patient-table-container').load('<?= site_url('user/table/patient') ?>');
		}

		function loadDoctorTable() {
			$('#doctor-table-container').load('<?= site_url('user/table/doctor') ?>');
		}

		function loadAdminTable() {
			$('#admin-table-container').load('<?= site_url('user/table/admin') ?>');
		}

		$('#patient-account-tab').click((e) => {
			loadPatientTable();
		});

		$('#doctor-account-tab').click((e) => {
			loadDoctorTable();
		});

		$('#admin-account-tab').click((e) => {
			loadAdminTable();
		});

		loadPatientTable();
		loadDoctorTable();
		loadAdminTable();
	})
</script>
