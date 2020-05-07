<div id="comments"></div>
<script>
	$(() => {
		const isDoctor = '<?= $this->session->userdata('login')['account_type'] ?>' === 'doctor'
		$.getJSON('<?= site_url("comment/fetch/{$id}") ?>', (data) => {
			$.each(data, (i, comment) => {
				$(`<div class="card text-white bg-dark" id="${comment.comment_id}-comment-card">`).append(
					$('<div class="card-body">').append(
						$('<h5 class="card-title">').text(comment.name),
						$('<h6 class="card-subtitle text-muted">').text(comment.comment_date),
						$('<hr>'),
						$('<div class="card-text">').text(comment.comment_caption)
					)
				).appendTo('#comments');
				if (isDoctor) {
					$('<button type="button" class="close">').append(
						$('<i class="fas fa-backspace">')
					).click((e) => {
						e.preventDefault();
						$.ajax({
							type: 'POST',
							url: '<?= site_url('comment/delete') ?>',
							data: {
								comment_id: comment.comment_id
							},
							success: (result) => {
								$(`#${comment.comment_id}-comment-card`).remove();
							}
						})
					}).prependTo(`#${comment.comment_id}-comment-card .card-body`)
				}
			})
		});
	});
</script>
