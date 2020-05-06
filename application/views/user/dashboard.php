<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3">
			<div class="nav flex-column nav-pills" id="dashboard-tab" role="tablist" aria-orientation="vertical">
				<?php if ($this->session->userdata('login')['account_type'] === 'admin') : ?>
					<a class="nav-link active" id="account-management-tab" data-toggle="pill" href="#account-management" role="tab" aria-controls="account-management" aria-selected="true">Account Management</a>
					<a class="nav-link" id="document-management-tab" data-toggle="pill" href="#document-management" role="tab" aria-controls="document-management" aria-selected="false">Document Management</a>
					<a class="nav-link" id="schedule-management-tab" data-toggle="pill" href="#schedule-management" role="tab" aria-controls="schedule-management" aria-selected="false">Schedule Management</a>
				<?php else : ?>
					<a class="nav-link active" id="reservation-tab" data-toggle="pill" href="#reservation" role="tab" aria-controls="reservation" aria-selected="true">Reservation</a>
					<a class="nav-link" id="document-tab" data-toggle="pill" href="#document" role="tab" aria-controls="document" aria-selected="false">Documents</a>
					<?php if ($this->session->userdata('login')['account_type'] === 'doctor') : ?>
						<a class="nav-link" id="doctor-schedule-tab" data-toggle="pill" href="#doctor-schedule" role="tab" aria-controls="doctor-schedule" aria-selected="false">Schedule</a>
					<?php endif; ?>
				<?php endif; ?>
				<a class="nav-link" id="personal-account-tab" data-toggle="pill" href="#personal-account" role="tab" aria-controls="personal-account" aria-selected="false">Manage Personal Account</a>
			</div>
		</div>
		<div class="col-lg-9">
			<div class="tab-content" id="dashboard-content">
				<?php if ($this->session->userdata('login')['account_type'] === 'admin') : ?>
					<div class="tab-pane fade show active" id="account-management" role="tabpanel" aria-labelledby="account-management-tab">
						<?php $this->load->view('admin/account_management') ?>
					</div>
					<div class="tab-pane fade" id="document-management" role="tabpanel" aria-labelledby="document-management-tab"></div>
					<div class="tab-pane fade" id="schedule-management" role="tabpanel" aria-labelledby="schedule-management-tab"></div>
				<?php else : ?>
					<div class="tab-pane fade show active" id="reservation" role="tabpanel" aria-labelledby="reservation-tab">
						<?php if ($this->session->userdata('login')['account_type'] === 'patient') : ?>
							<?php $this->load->view('reservation/form') ?>
						<?php endif; ?>
						<div id="reservation-table-container"></div>
					</div>
					<div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">Document</div>
					<?php if ($this->session->userdata('login')['account_type'] === 'doctor') : ?>
						<div class="tab-pane fade" id="doctor-schedule" role="tabpanel" aria-labelledby="doctor-schedule-tab"></div>
					<?php endif; ?>
				<?php endif; ?>
				<div class="tab-pane fade" id="personal-account" role="tabpanel" aria-labelledby="personal-account-tab">
					<form action="" method="POST">
						<input type="hidden" name="account_id" id="personal-account-id">
						<input type="hidden" name="account_type" id="personal-account-type" value="<?= $this->session->userdata('login')['account_type'] ?>">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="Username">Username*</label>
									<input type="text" name="username" id="personal-account-username-field" class="form-control" placeholder="Enter Username" maxlength="10" value="<?= $this->session->userdata('login')['username'] ?>" disabled>
									<small class="text-danger" id="personal-account-username-alert"></small>
								</div>
								<div class="form-group">
									<label for="Password">Password*</label>
									<input type="password" name="password" id="personal-account-password-field" class="form-control" placeholder="Enter Password" maxlength="20">
									<small class="text-danger" id="personal-account-password-alert"></small>
								</div>
								<div class="form-group">
									<label for="Name">Name*</label>
									<input type="text" name="complete_name" id="personal-account-complete-name-field" class="form-control" placeholder="Enter Name" maxlength="40">
									<small class="text-danger" id="personal-account-name-alert"></small>
								</div>
								<div class="form-group">
									<label for="Birth Information">Birth Information*</label>
									<div class="input-group">
										<input type="text" name="place_of_birth" id="personal-account-place-of-birth-field" class="form-control" placeholder="Enter Place Of Birth" maxlength="20">
										<input type="date" name="date_of_birth" id="personal-account-date-of-birth-field" class="form-control" placeholder="Enter Date Of Birth">
									</div>
									<small class="text-danger" id="personal-account-birth-information-alert"></small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Phone Number">Phone Number*</label>
									<input type="text" name="phone_number" id="personal-account-phone-number-field" class="form-control" placeholder="Enter Phone Number" maxlength="15">
									<small class="text-danger" id="personal-account-phone-number-alert"></small>
								</div>
								<div class="form-group">
									<label for="E-Mail">E-Mail*</label>
									<input type="text" name="email" id="personal-account-email-field" class="form-control" placeholder="Enter E-Mail" maxlength="30">
									<small class="text-danger" id="personal-account-email-alert"></small>
								</div>
								<div class="form-group">
									<label for="Address">Address*</label>
									<input type="text" name="address" id="personal-account-address-field" class="form-control" placeholder="Enter Address" maxlength="50">
									<small class="text-danger" id="personal-account-address-alert"></small>
								</div>
								<?php if ($this->session->userdata('login')['account_type'] === 'doctor') : ?>
									<div class="form-group">
										<label for="Doctor Information">Doctor Information*</label>
										<div class="input-group">
											<input type="text" name="doctor_type" id="personal-account-doctor-type-field" class="form-control" placeholder="Enter Doctor Type" maxlength="10" disabled>
											<input type="text" name="doctor_room" id="personal-account-doctor-room-field" class="form-control" placeholder="Enter Doctor Room" maxlength="10" disabled>
										</div>
										<small class="text-danger" id="personal-account-doctor-information-alert"></small>
									</div>
								<?php endif; ?>
								<div class="form-group">
									<label for="Buttons">Actions</label>
									<br>
									<div class="btn-group">
										<button type="reset" class="btn btn-outline-dark">Reset</button>
										<button type="submit" class="btn btn-outline-dark" id="update-personal-account">Update</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {
		function loadReservationTable() {
			$('#reservation-table-container').load('<?= site_url('reservation/table') ?>');
		}

		function loadDocumentManagement() {
			$('#document-management').load('<?= site_url('document/admin_management') ?>');
		}

		function loadScheduleManagement() {
			$('#schedule-management').load('<?= site_url('schedule/admin_management') ?>');
		}

		function loadScheduleTable() {
			$('#doctor-schedule').load('<?= site_url('schedule/table') ?>');
		}

		$('#document-management-tab').click((e) => {
			loadDocumentManagement();
		});

		$('#schedule-management-tab').click((e) => {
			loadScheduleManagement();
		});

		$('#reservation-tab').click((e) => {
			loadReservationTable();
		});

		$('#doctor-schedule-tab').click((e) => {
			loadScheduleTable();
		});

		$('#update-personal-account').click((e) => {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('user/update') ?>',
				data: {
					username: $('#personal-account-username-field').val(),
					password: $('#personal-account-password-field').val(),
					account_type: $('#personal-account-type').val(),
					complete_name: $('#personal-account-complete-name-field').val(),
					place_of_birth: $('#personal-account-place-of-birth-field').val(),
					date_of_birth: $('#personal-account-date-of-birth-field').val(),
					phone_number: $('#personal-account-phone-number-field').val(),
					email: $('#personal-account-email-field').val(),
					address: $('#personal-account-address-field').val(),
					doctor_type: $('#personal-account-doctor-type-field').val(),
					doctor_room: $('#personal-account-doctor-room-field').val()
				},
				success: (result) => {
					result = JSON.parse(result);
					if (result.error) {
						console.log(result.error);
						console.log($('#personal-account-username-alert'))
						$('#personal-account-username-alert').text(result.error.username);
						$('#personal-account-password-alert').text(result.error.password);
						$('#personal-account-name-alert').text(result.error.completeName);
						$('#personal-account-birth-information-alert').text(result.error.birthInformation);
						$('#personal-account-phone-number-alert').text(result.error.phoneNumber);
						$('#personal-account-email-alert').text(result.error.email);
						$('#personal-account-address-alert').text(result.error.address);
						$('#personal-account-doctor-information-alert').text(result.error.doctorInformation);
					} else {
						location.href = '<?= site_url('dashboard') ?>';
					}
				}
			});
		});

		$.ajax({
			type: 'GET',
			url: '<?= site_url('user/fetch_login_data') ?>',
			success: (result) => {
				result = JSON.parse(result);
				console.log(result);
				$('#personal-account-id').val(result.id);
				$('#personal-account-username-field').val(result.username);
				$('#personal-account-password-field').val(result.password);
				$('#personal-account-type').val(result.account_type);
				$('#personal-account-complete-name-field').val(result.complete_name);
				$('#personal-account-place-of-birth-field').val(result.place_of_birth);
				$('#personal-account-date-of-birth-field').val(result.date_of_birth);
				$('#personal-account-phone-number-field').val(result.phone_number);
				$('#personal-account-email-field').val(result.email);
				$('#personal-account-address-field').val(result.address);
				$('#personal-account-doctor-type-field').val(result.doctor_type);
				$('#personal-account-doctor-room-field').val(result.doctor_room);
			}
		});
		loadReservationTable();
		loadDocumentManagement();
		loadScheduleManagement();
		loadScheduleTable();
	});
</script>
