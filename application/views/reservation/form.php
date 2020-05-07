<button type="button" class="btn btn-outline-dark mb-3" data-toggle="modal" data-target="#reservation-input-form"><i class="fas fa-calendar-plus"></i> Create Reservation</button>

<div class="modal fade" id="reservation-input-form" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create Reservation</h5>
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
								<select name="doctor_id" id="reservation-doctor-select" class="custom-select">
									<option value="" selected>Doctor Name - Type</option>
								</select>
								<small class="text-danger" id="reservation-doctor-alert"></small>
							</div>
							<div class="form-group">
								<label for="Day and Time">Select Day</label>
								<select name="reservation_day" class="custom-select" id="reservation-day-select">
									<option value="" selected>--Day--</option>
								</select>
								<small class="text-danger" id="reservation-day-alert"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="Start Time">Reservation Time</label>
								<input type="time" name="reservation_time" class="form-control" id="reservation-time-field">
								<small class="text-danger" id="reservation-time-alert"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="Reservation Caption">Caption</label>
								<textarea name="reservation_caption" class="form-control" id="reservation-caption-textarea"></textarea>
								<small class="text-danger" id="reservation-caption-alert"></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="btn-group">
									<button class="btn btn-outline-dark" type="reset">Reset</button>
									<button class="btn btn-dark" id="save-reservation">Reserve</button>
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
<script>
	$(() => {
		$.ajax({
			type: 'GET',
			url: '<?= site_url('user/fetch/doctor') ?>',
			success: (result) => {
				result = JSON.parse(result);
				$.each(result.users, (i, doctor) => {
					$('<option>').val(doctor.id).text(`${doctor.complete_name} - ${doctor.doctor_type}`)
						.appendTo('#reservation-doctor-select');
				})
			}
		});
		$('#reservation-doctor-select').change((e) => {
			$.ajax({
				type: 'GET',
				url: `<?= site_url('schedule/fetch/') ?>${$('#reservation-doctor-select').val()}`,
				success: (result) => {
					result = JSON.parse(result);
					$('#reservation-day-select').empty();
					$('<option>').val('').text('--Day--').attr('selected', 'selected')
						.appendTo('#reservation-day-select');
					$.each(result, (i, schedule) => {
						const opt = $('<option>').val(schedule.schedule_id).text(schedule.day);
						const str = opt.text();
						opt.text(`${str.charAt(0).toUpperCase() + str.substr(1).toLowerCase()} - ${schedule.start_time} to ${schedule.finish_time}`)
							.appendTo('#reservation-day-select');
					})
				}
			})
		})
		$('#save-reservation').click((e) => {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('reservation/create') ?>',
				data: {
					doctor_id: $('#reservation-doctor-select').val(),
					reservation_day: $('#reservation-day-select').val(),
					reservation_time: $('#reservation-time-field').val(),
					reservation_caption: $('#reservation-caption-textarea').val()
				},
				success: (result) => {
					result = JSON.parse(result);
					if (result.error) {
						$('#reservation-doctor-alert').text(result.error.doctorId);
						$('#reservation-day-alert').text(result.error.reservationDay);
						$('#reservation-time-alert').text(result.error.reservationTime);
						$('#reservation-caption-alert').text(result.error.reservationCaption);
					} else {
						$('#reservation-input-form').modal('toggle');
						$('.modal-backdrop').remove();
						$('#reservation-table-container').load('<?= site_url('reservation/table') ?>');
					}
				}
			})
		})
	})
</script>
