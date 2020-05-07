<table id="<?= $account_type ?>-table" class="table table-striped table-bordered">
	<thead class="thead-dark">
		<th>No</th>
		<th>ID</th>
		<th>Username</th>
		<th>Name</th>
		<th>Created Date</th>
		<th>Action</th>
	</thead>
	<tbody class="table-hovered" id="<?= $account_type ?>-table-body">
	</tbody>
</table>
<div class="modal fade" id="<?= $account_type ?>-form-update" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Account</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST">
				<div class="modal-body">
					<input type="hidden" name="account_id" id="<?= $account_type ?>-id-update">
					<input type="hidden" name="account_type" id="<?= $account_type ?>-type-update" value="<?= $account_type ?>">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="Username">Username*</label>
								<input type="text" name="username" id="<?= $account_type ?>-username-field-update" class="form-control" placeholder="Enter Username" maxlength="10" disabled>
								<small class="text-danger" id="<?= $account_type ?>-username-alert-update"></small>
							</div>
							<div class="form-group">
								<label for="Password">Password*</label>
								<input type="password" name="password" id="<?= $account_type ?>-password-field-update" class="form-control" placeholder="Enter Password" maxlength="20" disabled>
								<small class=" text-danger" id="<?= $account_type ?>-password-alert-update"></small>
							</div>
							<div class="form-group">
								<label for="Name">Name*</label>
								<input type="text" name="complete_name" id="<?= $account_type ?>-complete-name-field-update" class="form-control" placeholder="Enter Name" maxlength="40">
								<small class="text-danger" id="<?= $account_type ?>-name-alert-update"></small>
							</div>
							<div class="form-group">
								<label for="Birth Information">Birth Information*</label>
								<div class="input-group">
									<input type="text" name="place_of_birth" id="<?= $account_type ?>-place-of-birth-field-update" class="form-control" placeholder="Enter Place Of Birth" maxlength="20">
									<input type="date" name="date_of_birth" id="<?= $account_type ?>-date-of-birth-field-update" class="form-control" placeholder="Enter Date Of Birth">
								</div>
								<small class="text-danger" id="<?= $account_type ?>-birth-information-alert-update"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="Phone Number">Phone Number*</label>
								<input type="text" name="phone_number" id="<?= $account_type ?>-phone-number-field-update" class="form-control" placeholder="Enter Phone Number" maxlength="15">
								<small class="text-danger" id="<?= $account_type ?>-phone-number-alert-update"></small>
							</div>
							<div class="form-group">
								<label for="E-Mail">E-Mail*</label>
								<input type="text" name="email" id="<?= $account_type ?>-email-field-update" class="form-control" placeholder="Enter E-Mail" maxlength="30">
								<small class="text-danger" id="<?= $account_type ?>-email-alert-update"></small>
							</div>
							<div class="form-group">
								<label for="Address">Address*</label>
								<input type="text" name="address" id="<?= $account_type ?>-address-field-update" class="form-control" placeholder="Enter Address" maxlength="50">
								<small class="text-danger" id="<?= $account_type ?>-address-alert-update"></small>
							</div>
							<?php if ($account_type === 'doctor') : ?>
								<div class="form-group">
									<label for="Doctor Information">Doctor Information*</label>
									<div class="input-group">
										<input type="text" name="doctor_type" id="<?= $account_type ?>-type-field-update" class="form-control" placeholder="Enter Doctor Type" maxlength="10">
										<input type="text" name="doctor_room" id="<?= $account_type ?>-room-field-update" class="form-control" placeholder="Enter Doctor Room" maxlength="10">
									</div>
									<small class="text-danger" id="<?= $account_type ?>-information-alert-update"></small>
								</div>
							<?php endif; ?>
							<div class="form-group">
								<label for="Buttons">Actions</label>
								<br>
								<div class="btn-group">
									<button type="reset" class="btn btn-outline-dark">Reset</button>
									<button type="submit" class="btn btn-dark" id="update-<?= $account_type ?>">Update</button>
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
<div class="modal fade" id="<?= $account_type ?>-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">Are you sure want to delete <span id="delete-<?= $account_type ?>-prompt"></span>?</div>
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-dark" id="delete-<?= $account_type ?>" data-dismiss="modal">Yes</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {
		function updateAccount(username) {
			$.ajax({
				url: `<?= site_url("user/fetch_one/{$account_type}/") ?>${username}`,
				type: 'GET',
				success: result => {
					result = JSON.parse(result);
					$('#<?= $account_type ?>-id-update').val(result.id);
					$('#<?= $account_type ?>-username-field-update').val(result.username);
					$('#<?= $account_type ?>-password-field-update').val(result.password);
					$('#<?= $account_type ?>-complete-name-field-update').val(result.complete_name);
					$('#<?= $account_type ?>-place-of-birth-field-update').val(result.place_of_birth);
					$('#<?= $account_type ?>-date-of-birth-field-update').val(result.date_of_birth);
					$('#<?= $account_type ?>-phone-number-field-update').val(result.phone_number);
					$('#<?= $account_type ?>-email-field-update').val(result.email);
					$('#<?= $account_type ?>-address-field-update').val(result.address);
					$('#<?= $account_type ?>-type-field-update').val(result.doctor_type);
					$('#<?= $account_type ?>-room-field-update').val(result.doctor_room);
				}
			})
			$('#update-<?= $account_type ?>').click(e => {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '<?= site_url('user/update') ?>',
					data: {
						patient_id: $('#<?= $account_type ?>-id-update').val(),
						doctor_id: $('#<?= $account_type ?>-id-update').val(),
						admin_id: $('#<?= $account_type ?>-id-update').val(),
						username: $('#<?= $account_type ?>-username-field-update').val(),
						password: $('#<?= $account_type ?>-password-field-update').val(),
						account_type: $('#<?= $account_type ?>-type-update').val(),
						complete_name: $('#<?= $account_type ?>-complete-name-field-update').val(),
						place_of_birth: $('#<?= $account_type ?>-place-of-birth-field-update').val(),
						date_of_birth: $('#<?= $account_type ?>-date-of-birth-field-update').val(),
						phone_number: $('#<?= $account_type ?>-phone-number-field-update').val(),
						email: $('#<?= $account_type ?>-email-field-update').val(),
						address: $('#<?= $account_type ?>-address-field-update').val(),
						doctor_type: $('#<?= $account_type ?>-type-field-update').val(),
						doctor_room: $('#<?= $account_type ?>-room-field-update').val()
					},
					success: (result) => {
						result = JSON.parse(result);
						if (result.error) {
							$('#<?= $account_type ?>-username-alert-update').text(result.error.username);
							$('#<?= $account_type ?>-password-alert-update').text(result.error.password);
							$('#<?= $account_type ?>-name-alert-update').text(result.error.completeName);
							$('#<?= $account_type ?>-birth-information-alert-update').text(result.error.birthInformation);
							$('#<?= $account_type ?>-phone-number-alert-update').text(result.error.phoneNumber);
							$('#<?= $account_type ?>-email-alert-update').text(result.error.email);
							$('#<?= $account_type ?>-address-alert-update').text(result.error.address);
							$('#<?= $account_type ?>-information-alert-update').text(result.error.doctorInformation);
						} else {
							$('.modal-backdrop').remove();
							$('#<?= $account_type ?>-table-container').load('<?= site_url("user/table/{$account_type}") ?>');
						}
					}
				});
			});
		}

		function deleteAccount(username) {
			$('#delete-<?= $account_type ?>-prompt').text(username);
			$('#delete-<?= $account_type ?>').click(e => {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '<?= site_url('user/delete') ?>',
					data: {
						username: username
					},
					success: (result) => {
						$('.modal-backdrop').remove();
						$('#<?= $account_type ?>-table-container').load('<?= site_url("user/table/{$account_type}") ?>');
					}
				});
			});
		}
		$.getJSON('<?= site_url("user/fetch/{$account_type}") ?>', (data) => {
			$.each(data.users, (i, user) => {
				$(`<tr id="${data.account_type}-${user.id}">`).append(
					$(`<td id="${data.account_type}-${user.id}-n">`).text(i + 1),
					$(`<td id="${data.account_type}-${user.id}-id">`).text(user.id),
					$(`<td id="${data.account_type}-${user.id}-username">`).text(user.username),
					$(`<td id="${data.account_type}-${user.id}-name">`).text(user.complete_name),
					$(`<td id="${data.account_type}-${user.id}-created-date">`).text(user.account_created),
					$(`<td id="${data.account_type}-${user.id}-action">`).append(
						$('<div class="btn-group">').append(
							$('<button>').attr({
								'value': user.id,
								'class': 'btn btn-outline-dark',
								'data-toggle': 'modal',
								'data-target': `#${data.account_type}-form-update`
							}).append(
								$('<i>').attr({
									'class': 'fas fa-user-edit'
								})
							).click((e) => {
								e.preventDefault();
								updateAccount(user.username);
							}),
							$('<button>').attr({
								'value': user.username,
								'class': 'btn btn-outline-dark',
								'data-toggle': 'modal',
								'data-target': `#${data.account_type}-delete`
							}).append(
								$('<i>').attr({
									'class': 'fas fa-user-times'
								})
							)).click((e) => {
							e.preventDefault();
							deleteAccount(user.username);
						})
					)
				).appendTo('#<?= $account_type ?>-table-body');
			})
			$('#<?= $account_type ?>-table').DataTable();
		});
	});
</script>
