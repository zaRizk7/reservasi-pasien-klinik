<table id="document-table" class="table table-striped table-bordered">
	<thead class="thead-dark">
		<th>No</th>
		<th>ID</th>
		<th>Type</th>
		<th>Name</th>
		<th>Format</th>
		<th>Size</th>
		<th>Username</th>
		<th>Action</th>
	</thead>
	<tbody class="table-hovered" id="document-table-content">
	</tbody>
</table>
<div class="modal fade" id="document-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">Are you sure want to delete this document?</div>
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-dark" id="delete-document" data-dismiss="modal">Yes</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {
		$.getJSON('<?= site_url('document/fetch') ?>', (data) => {
			$.each(data, (i, document) => {
				$('<tr>').append(
					$('<td>').text(i + 1),
					$('<td>').text(document.document_id),
					$('<td>').text(document.document_type),
					$('<td>').text(document.document_name),
					$('<td>').text(document.document_format),
					$('<td>').text(document.document_size),
					$('<td>').text(document.username),
					$('<td>').append(
						$('<div class="btn-group">').append(
							$('<button class="btn btn-outline-dark">').append(
								$('<i class="fas fa-eye">')
							).click((e) => {
								e.preventDefault();
								if (document.document_type === 'portrait') {
									document.document_type = 'portrait_photo';
								}
								const win = window.open(`<?= base_url('uploads/') ?>${document.document_type}/${document.document_name}${document.document_format}`, '_blank');
								if (win) {
									win.focus();
								}
							}),
							$('<button class="btn btn-outline-dark">').append(
								$('<i class="fas fa-trash">')
							).attr({
								'data-toggle': 'modal',
								'data-target': '#document-delete'
							}).click((e) => {
								e.preventDefault();
								$('#delete-document').click((e) => {
									$.ajax({
										type: 'POST',
										url: '<?= site_url('document/delete') ?>',
										data: {
											document_name: document.document_name,
											document_type: document.document_type
										},
										success: (result) => {
											$('.modal-backdrop').remove();
											$('#document-table-container').load('<?= site_url('document/table') ?>');
										}
									});
								});
							})
						)
					),
				).appendTo('#document-table-content');
			});
			$('#document-table').DataTable();
		})
	});
</script>
