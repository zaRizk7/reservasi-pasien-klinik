<div class="modal fade" id="add-<?= $account_type ?>-form" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Register Account</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST">
				<div class="modal-body">
					<input type="hidden" name="account_type" id="<?= $account_type ?>-type" value="<?= $account_type ?>">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="Username">Username*</label>
								<input type="text" name="username" id="<?= $account_type ?>-username-field" class="form-control" placeholder="Enter Username" maxlength="10">
								<small class="text-danger" id="<?= $account_type ?>-username-alert"></small>
							</div>
							<div class="form-group">
								<label for="Password">Password*</label>
								<input type="password" name="password" id="<?= $account_type ?>-password-field" class="form-control" placeholder="Enter Password" maxlength="20">
								<small class="text-danger" id="<?= $account_type ?>-password-alert"></small>
							</div>
							<div class="form-group">
								<label for="Name">Name*</label>
								<input type="text" name="complete_name" id="<?= $account_type ?>-complete-name-field" class="form-control" placeholder="Enter Name" maxlength="40">
								<small class="text-danger" id="<?= $account_type ?>-name-alert"></small>
							</div>
							<div class="form-group">
								<label for="Birth Information">Birth Information*</label>
								<div class="input-group">
									<input type="text" name="place_of_birth" id="<?= $account_type ?>-place-of-birth-field" class="form-control" placeholder="Enter Place Of Birth" maxlength="20">
									<input type="date" name="date_of_birth" id="<?= $account_type ?>-date-of-birth-field" class="form-control" placeholder="Enter Date Of Birth">
								</div>
								<small class="text-danger" id="<?= $account_type ?>-birth-information-alert"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="Phone Number">Phone Number*</label>
								<input type="text" name="phone_number" id="<?= $account_type ?>-phone-number-field" class="form-control" placeholder="Enter Phone Number" maxlength="15">
								<small class="text-danger" id="<?= $account_type ?>-phone-number-alert"></small>
							</div>
							<div class="form-group">
								<label for="E-Mail">E-Mail*</label>
								<input type="text" name="email" id="<?= $account_type ?>-email-field" class="form-control" placeholder="Enter E-Mail" maxlength="100">
								<small class="text-danger" id="<?= $account_type ?>-email-alert"></small>
							</div>
							<div class="form-group">
								<label for="Address">Address*</label>
								<input type="text" name="address" id="<?= $account_type ?>-address-field" class="form-control" placeholder="Enter Address" maxlength="50">
								<small class="text-danger" id="<?= $account_type ?>-address-alert"></small>
							</div>
							<?php if ($account_type === 'doctor') : ?>
								<div class="form-group">
									<label for="Doctor Information">Doctor Information*</label>
									<div class="input-group">
										<input type="text" name="doctor_type" id="<?= $account_type ?>-type-field" class="form-control" placeholder="Enter Doctor Type" maxlength="10">
										<input type="text" name="doctor_room" id="<?= $account_type ?>-room-field" class="form-control" placeholder="Enter Doctor Room" maxlength="10">
									</div>
									<small class="text-danger" id="<?= $account_type ?>-information-alert"></small>
								</div>
							<?php endif; ?>
							<div class="form-group">
								<label for="Buttons">Actions</label>
								<br>
								<div class="btn-group">
									<button type="reset" class="btn btn-outline-dark">Reset</button>
									<button type="submit" class="btn btn-dark" id="register-<?= $account_type ?>">Register</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<p>ServeHealth</p>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(() => {
		$('#register-<?= $account_type ?>').click(e => {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('user/register') ?>',
				data: {
					username: $('#<?= $account_type ?>-username-field').val(),
					password: $('#<?= $account_type ?>-password-field').val(),
					account_type: $('#<?= $account_type ?>-type').val(),
					complete_name: $('#<?= $account_type ?>-complete-name-field').val(),
					place_of_birth: $('#<?= $account_type ?>-place-of-birth-field').val(),
					date_of_birth: $('#<?= $account_type ?>-date-of-birth-field').val(),
					phone_number: $('#<?= $account_type ?>-phone-number-field').val(),
					email: $('#<?= $account_type ?>-email-field').val(),
					address: $('#<?= $account_type ?>-address-field').val(),
					doctor_type: $('#<?= $account_type ?>-type-field').val(),
					doctor_room: $('#<?= $account_type ?>-room-field').val()
				},
				success: (result) => {
					result = JSON.parse(result)
					if (result.error) {
						$('#<?= $account_type ?>-username-alert').text(result.error.username);
						$('#<?= $account_type ?>-password-alert').text(result.error.password);
						$('#<?= $account_type ?>-name-alert').text(result.error.completeName);
						$('#<?= $account_type ?>-birth-information-alert').text(result.error.birthInformation);
						$('#<?= $account_type ?>-phone-number-alert').text(result.error.phoneNumber);
						$('#<?= $account_type ?>-email-alert').text(result.error.email);
						$('#<?= $account_type ?>-address-alert').text(result.error.address);
						$('#<?= $account_type ?>-information-alert').text(result.error.doctorInformation);
					} else {
						<?php if (!$this->session->userdata('login')) : ?>
							$.ajax({
								type: 'POST',
								url: '<?= site_url('user/login') ?>',
								data: {
									username: result.data.username,
									password: result.data.password
								},
								success: (data) => {
									location.href = '<?= site_url('dashboard') ?>';
								}
							});
						<?php else : ?>
							$('#add-<?= $account_type ?>-form').modal('toggle');
							$('#<?= $account_type ?>-table-container').load('<?= site_url("user/table/{$account_type}") ?>');
						<?php endif; ?>
					}
				}
			});
		});
	});
</script>
