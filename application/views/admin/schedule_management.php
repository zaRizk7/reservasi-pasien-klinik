<button type="button" class="btn btn-outline-dark mb-3" data-toggle="modal" data-target="#schedule-input-form"><i class="fas fa-calendar-plus"></i> Create Schedule</button>

<div class="modal fade" id="schedule-input-form" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create Schedule</h5>
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
								<select name="doctor_id" id="schedule-doctor-select" class="custom-select">
									<option value="" selected>Doctor ID - Doctor Name</option>
								</select>
								<small class="text-danger" id="schedule-doctor-id-alert"></small>
							</div>
							<div class="form-group">
								<label for="Day and Time">Select Day</label>
								<select name="day" class="custom-select" id="schedule-day-field">
									<option value="" selected>Day</option>
									<option value="monday">Monday</option>
									<option value="tuesday">Tuesday</option>
									<option value="wednesday">Wednesday</option>
									<option value="thursday">Thursday</option>
									<option value="friday">Friday</option>
									<option value="saturday">Saturday</option>
									<option value="sunday">Sunday</option>
								</select>
								<small class="text-danger" id="schedule-day-alert"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="Start Time">Start Time</label>
								<input type="time" name="start_time" class="form-control" id="schedule-start-time-field">
								<small class="text-danger" id="schedule-start-time-alert"></small>
							</div>
							<div class="form-group">
								<label for="Finish Time">Finish Time</label>
								<input type="time" name="finish_time" class="form-control" id="schedule-finish-time-field">
								<small class="text-danger" id="schedule-finish-time-alert"></small>
							</div>
							<div class="form-group">
								<div class="btn-group">
									<button class="btn btn-outline-dark" type="reset">Reset</button>
									<button class="btn btn-dark" id="save-schedule">Save</button>
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
<div id="schedule-table-container"></div>
<script>
	$(() => {
		$('#schedule-table-container').load('<?= site_url('schedule/table') ?>');
		$.getJSON('<?= site_url('user/fetch/doctor') ?>', (data) => {
			console.log(data);
			$.each(data.users, (i, doctor) => {
				$('<option>').val(doctor.id)
					.text(`${doctor.id} - ${doctor.complete_name}`)
					.appendTo('#schedule-doctor-select');
			})
		});
		$('#save-schedule').click(e => {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('schedule/create') ?>',
				data: {
					doctor_id: $('#schedule-doctor-select').val(),
					day: $('#schedule-day-field').val(),
					start_time: $('#schedule-start-time-field').val(),
					finish_time: $('#schedule-finish-time-field').val()
				},
				success: (result) => {
					result = JSON.parse(result);
					console.log(result);
					if (result.error) {
						$('#schedule-doctor-id-alert').text(result.error.doctorId);
						$('#schedule-day-alert').text(result.error.day);
						$('#schedule-start-time-alert').text(result.error.startTime);
						$('#schedule-finish-time-alert').text(result.error.finishTime);
					} else {
						$('#schedule-input-form').modal('toggle');
						$('#schedule-table-container').load('<?= site_url("schedule/table/") ?>');
					}
				}
			});
		});
	});
</script>
