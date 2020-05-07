<table id="schedule-table" class="table table-striped table-bordered" width="100%">
	<thead class="thead-dark">
		<th>No</th>
		<?php if ($this->session->userdata('login')['account_type'] === 'admin') : ?>
			<th>Schedule ID</th>
			<th>Doctor ID</th>
			<th>Name</th>
		<?php endif; ?>
		<th>Day</th>
		<th>Start Time</th>
		<th>Finish Time</th>
		<?php if ($this->session->userdata('login')['account_type'] === 'admin') : ?>
			<th>Action</th>
		<?php endif; ?>
	</thead>
	<tbody class="table-hovered" id="schedule-table-body">
	</tbody>
</table>
<div class="modal fade" id="schedule-update-form" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Schedule</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="Doctor">Doctor</label>
								<input type="text" name="doctor_id" class="form-control" id="schedule-doctor-id-update" disabled>
							</div>
							<div class="form-group">
								<label for="Schedule ID">Schedule ID</label>
								<input type="text" name="schedule_id" class="form-control" id="schedule-id-update" disabled>
							</div>
							<div class="form-group">
								<label for="Day and Time">Select Day</label>
								<select name="day" class="custom-select" id="schedule-day-update-field">
									<option value="" selected>Day</option>
									<option value="monday">Monday</option>
									<option value="tuesday">Tuesday</option>
									<option value="wednesday">Wednesday</option>
									<option value="thursday">Thursday</option>
									<option value="friday">Friday</option>
									<option value="saturday">Saturday</option>
									<option value="sunday">Sunday</option>
								</select>
								<small class="text-danger" id="schedule-day-update-alert"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="Start Time">Start Time</label>
								<input type="time" name="start_time" class="form-control" id="schedule-start-time-update-field">
								<small class="text-danger" id="schedule-start-time-update-alert"></small>
							</div>
							<div class="form-group">
								<label for="Finish Time">Finish Time</label>
								<input type="time" name="finish_time" class="form-control" id="schedule-finish-time-update-field">
								<small class="text-danger" id="schedule-finish-time-update-alert"></small>
							</div>
							<div class="form-group">
								<label for="Action">Actions</label>
								<br>
								<div class="btn-group">
									<button class="btn btn-outline-dark" type="reset">Reset</button>
									<button class="btn btn-dark" id="update-schedule">Save</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<p>ServeHealth</p>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="schedule-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">Are you sure want to delete this schedule?</div>
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-dark" id="delete-schedule" data-dismiss="modal">Yes</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {
		function updateSchedule(scheduleId) {
			$.ajax({
				url: `<?= site_url("schedule/fetch_one/") ?>${scheduleId}`,
				type: 'GET',
				success: result => {
					result = JSON.parse(result);
					$('#schedule-id-update').val(result.schedule_id);
					$('#schedule-day-update-field').val(result.day);
					$('#schedule-start-time-update-field').val(result.start_time);
					$('#schedule-finish-time-update-field').val(result.finish_time);
					$('#schedule-doctor-id-update').val(result.doctor_id);
				}
			})
			$('#update-schedule').click(e => {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '<?= site_url('schedule/update') ?>',
					data: {
						schedule_id: $('#schedule-id-update').val(),
						day: $('#schedule-day-update-field').val(),
						start_time: $('#schedule-start-time-update-field').val(),
						finish_time: $('#schedule-finish-time-update-field').val(),
						doctor_id: $('#schedule-doctor-id-update').val()
					},
					success: (result) => {
						result = JSON.parse(result);
						if (result.error) {
							$('#schedule-day-update-alert').text(result.error.day);
							$('#schedule-start-time-update-alert').text(result.error.startTime);
							$('#schedule-finish-time-update-alert').text(result.error.finishTime);
						} else {
							$('.modal-backdrop').remove();
							$('#schedule-table-container').load('<?= site_url("schedule/table") ?>');
						}
					}
				});
			});
		}

		function deleteSchedule(scheduleId) {
			$('#delete-schedule').click((e) => {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '<?= site_url('schedule/delete') ?>',
					data: {
						schedule_id: scheduleId
					},
					success: (result) => {
						result = JSON.parse(result);
						$('.modal-backdrop').remove();
						$('#schedule-table-container').load('<?= site_url("schedule/table") ?>');
					}
				});
			});
		}
		$.getJSON('<?= site_url("schedule/fetch/{$doctor_id}") ?>', (data) => {
			let isAdmin = '<?= $this->session->userdata('login')['account_type'] ?>' === 'admin';
			$.each(data, (i, schedule) => {
				$(`<tr id="${schedule.doctor_id}-${schedule.schedule_id}">`).append(
					$(`<td id="${schedule.schedule_id}-no">`).text(i + 1),
					$(`<td id="${schedule.schedule_id}-day">`).text(schedule.day),
					$(`<td id="${schedule.schedule_id}-start-time">`).text(schedule.start_time),
					$(`<td id="${schedule.schedule_id}-finish-time">`).text(schedule.finish_time),
				).appendTo('#schedule-table-body');
				if (isAdmin) {
					$(`<td id="${schedule.schedule_id}-schedule-id">`).text(schedule.schedule_id)
						.insertAfter(`#${schedule.schedule_id}-no`);
					$(`<td id="${schedule.schedule_id}-doctor-name">`).text(schedule.name)
						.insertAfter(`#${schedule.schedule_id}-schedule-id`);
					$(`<td id="${schedule.schedule_id}-doctor-id">`).text(schedule.doctor_id)
						.insertAfter(`#${schedule.schedule_id}-schedule-id`);
					$(`<td id="${schedule.schedule_id}-action">`).append(
							$('<div class="btn-group">').append(
								$('<button>').attr({
									'value': schedule.doctor_id,
									'class': 'btn btn-outline-dark',
									'data-toggle': 'modal',
									'data-target': `#schedule-update-form`
								}).append(
									$('<i>').attr({
										'class': 'fas fa-edit'
									})
								).click((e) => {
									e.preventDefault();
									updateSchedule(schedule.schedule_id);
								}),
								$('<button>').attr({
									'value': schedule.doctor_id,
									'class': 'btn btn-outline-dark',
									'data-toggle': 'modal',
									'data-target': `#schedule-delete`
								}).append(
									$('<i>').attr({
										'class': 'fas fa-times'
									})
								)).click((e) => {
								e.preventDefault();
								deleteSchedule(schedule.schedule_id);
							})
						)
						.appendTo(`#${schedule.doctor_id}-${schedule.schedule_id}`);
				}
			});
			$('#schedule-table').DataTable();
		});
	});
</script>
