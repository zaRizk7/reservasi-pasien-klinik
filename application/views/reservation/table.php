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
		<th>Action</th>
	</thead>
	<tbody class="table-hovered" id="reservation-table-body">
	</tbody>
</table>
<script>
	$(() => {
		isDoctor = '<?= $this->session->userdata('login')['account_type'] ?>' === 'doctor';
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
					).appendTo('#reservation-table-body');
					$(`<td id="action-${i+1}">`).append(
							$('<div class="btn-group">').append(
								$('<button>').attr({
									'value': reservation.id,
									'class': 'btn btn-outline-dark',
									'data-toggle': 'modal',
									'data-target': `#reservation-form-update`
								}).append(
									$('<i>').attr({
										'class': 'fas fa-eye'
									})
								),
								$('<button>').attr({
									'value': reservation.id,
									'class': 'btn btn-outline-dark',
									'data-toggle': 'modal',
									'data-target': `#reservation-delete`
								}).append(
									$('<i>').attr({
										'class': 'fas fa-times'
									})
								))
						)
						.insertAfter(`#caption-${i+1}`);
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
