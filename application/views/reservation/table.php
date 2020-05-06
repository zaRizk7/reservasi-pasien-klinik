<table id="reservation-table" class="table table-striped table-bordered">
	<thead class="thead-dark">
		<th>No</th>
		<?php if ($this->session->userdata('login')['account_type'] === 'patient') : ?>
			<th>Doctor Name</th>
			<th>Doctor Type</th>
		<?php else : ?>
			<th>Patient Name</th>
		<?php endif; ?>
		<th>Date</th>
		<th>Time</th>
		<th>Caption</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody class="table-hovered" id="reservation-table-body">
	</tbody>
</table>
<div class="modal fade" id="reservation-detail" tabindex="-1" role="document">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Reservation Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<?php if ($this->session->userdata('login')['account_type'] !== 'patient') : ?>
							<div class="form-group">
								<label for="Patient Name">Patient Name</label>
								<input type="text" class="form-control" id="reservation-detail-patient-name" disabled>
							</div>
						<?php else : ?>
							<div class="form-group">
								<label for="Doctor Name">Doctor Name</label>
								<input type="text" class="form-control" id="reservation-detail-doctor-name" disabled>
							</div>
							<div class="form-group">
								<label for="Doctor Type">Doctor Type</label>
								<input type="text" class="form-control" id="reservation-detail-doctor-type" disabled>
							</div>
						<?php endif; ?>
						<div class="form-group">
							<label for="Reservation Date">Date</label>
							<input type="text" class="form-control" id="reservation-detail-date" disabled>
						</div>
						<div class="form-group">
							<label for="Reservation Time">Time</label>
							<input type="text" class="form-control" id="reservation-detail-time" disabled>
						</div>
						<div class="form-group">
							<label for="Reservation Caption">Caption</label>
							<textarea id="reservation-detail-caption" cols="30" rows="10" class="form-control" disabled></textarea>
						</div>
						<div class="form-group">
							<label for="Reservation Status">Status</label>
							<input type="text" class="form-control" id="reservation-detail-status" disabled>
						</div>
						<div class="form-group">
							<label for="Action">Actions</label>
							<br>
							<div class="btn-group">
								<button class="btn btn-outline-dark" id="reservation-cancel-button">Cancel</button>
								<?php if ($this->session->userdata('login')['account_type'] === 'doctor') : ?>
									<button class="btn btn-outline-dark" id="reservation-finish-button">Finish</button>
									<button class="btn btn-outline-dark" id="reservation-delete-button">Delete</button>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div id="comment-input">
							<form action="" method="post">
								<input type="hidden" name="reservation_id" id="reservation-comment-id">
								<div class="form-group">
									<label for="Input Comment">Input Comment</label>
									<textarea name="comment_caption" class="form-control" id="reservation-comment-field" rows="5" placeholder="Input Comment"></textarea>
									<small class="text-danger" id="reservation-comment-alert"></small>
								</div>
								<div class="form-group">
									<div class="btn-group">
										<button class="btn btn-outline-dark" id="reset-comment" type="reset">Reset</button>
										<button class="btn btn-dark" id="reservation-comment-submit">Comment</button>
									</div>
								</div>
							</form>
						</div>
						<h6>Comments</h6>
						<div id="reservation-comments-container">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {
		isDoctor = '<?= $this->session->userdata('login')['account_type'] ?>' === 'doctor';
		$('#reservation-comment-submit').click((e) => {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('comment/create') ?>',
				data: {
					comment_caption: $('#reservation-comment-field').val(),
					reservation_id: $('#reservation-comment-id').val()
				},
				success: (result) => {
					result = JSON.parse(result);
					if (result.error) {
						$('#reservation-comment-alert').text(result.error.comment_caption);
					} else {
						$('#reservation-comments-container').load(`<?= site_url('comment/load_comment/') ?>${$('#reservation-comment-id').val()}`);
					}
				}
			})
		})
		$.ajax({
			type: 'GET',
			url: '<?= site_url('reservation/fetch') ?>',
			success: (result) => {
				result = JSON.parse(result);
				console.log(result);
				$.each(result, (i, reservation) => {
					$(`<tr id="reservation-${i+1}">`).append(
						$(`<td id="n-${i+1}">`).text(i + 1),
						$(`<td id="name-${i+1}">`).text(reservation.name),
						$(`<td id="date-${i+1}">`).text(reservation.reservation_date),
						$(`<td id="time-${i+1}">`).text(reservation.reservation_time),
						$(`<td id="caption-${i+1}">`).text(reservation.reservation_caption),
						$(`<td id="status-${i+1}">`).text(reservation.reservation_status)
					).appendTo('#reservation-table-body');
					$(`<td id="action-${i+1}">`).append(
							$('<button>').attr({
								'value': reservation.id,
								'class': 'btn btn-lg btn-outline-dark',
								'data-toggle': 'modal',
								'data-target': `#reservation-detail`
							}).click((e) => {
								e.preventDefault();
								$.ajax({
									type: 'GET',
									url: `<?= site_url('reservation/fetch_one/') ?>${reservation.id}`,
									success: (result) => {
										result = JSON.parse(result);
										console.log(result);
										if (reservation.reservation_status === 'cancelled' || reservation.reservation_status === 'finished') {
											$('#comment-input').hide();
											$('#reservation-finish-button').attr('disabled', true);
											$('#reservation-cancel-button').attr('disabled', true);
											$('#reservation-delete-button').removeAttr('disabled').click((e) => {
												e.preventDefault();
												$.ajax({
													type: 'POST',
													url: '<?= site_url('reservation/delete') ?>',
													data: {
														reservation_id: reservation.id
													},
													success: (result) => {
														location.href = '<?= site_url('dashboard') ?>';
													}
												})
											});
										} else {
											$('#comment-input').show();
											$('#reservation-finish-button').removeAttr('disabled').click((e) => {
												e.preventDefault();
												$.ajax({
													type: 'POST',
													url: '<?= site_url('reservation/finish_reservation') ?>',
													data: {
														reservation_id: reservation.id
													},
													success: (result) => {
														location.href = '<?= site_url('dashboard') ?>';
													}
												})
											});
											$('#reservation-cancel-button').removeAttr('disabled').click((e) => {
												e.preventDefault();
												$.ajax({
													type: 'POST',
													url: '<?= site_url('reservation/cancel_reservation') ?>',
													data: {
														reservation_id: reservation.id
													},
													success: (result) => {
														location.href = '<?= site_url('dashboard') ?>';
													}
												})
											});
											$('#reservation-delete-button').attr('disabled', true);
										}
										$('#reservation-comment-id').val(result.id);
										$('#reservation-detail-patient-name').val(result.patient_name);
										$('#reservation-detail-doctor-name').val(result.doctor_name);
										$('#reservation-detail-doctor-type').val(result.doctor_type);
										$('#reservation-detail-date').val(result.reservation_date);
										$('#reservation-detail-time').val(result.reservation_time);
										$('#reservation-detail-caption').val(result.reservation_caption);
										$('#reservation-detail-status').val(result.reservation_status);
										$('#reservation-comments-container').load(`<?= site_url('comment/load_comment/') ?>${result.id}`);
									}
								});
							}).append(
								$('<i>').attr({
									'class': 'fas fa-eye'
								})
							)
						)
						.insertAfter(`#status-${i+1}`);
					if (!isDoctor) {
						$(`<td id="doctor-type-${i+1}">`).text(reservation.doctor_type)
							.insertAfter(`#name-${i+1}`);
					}
				});
				$('#reservation-table').DataTable();
			}
		});
	});
</script>
