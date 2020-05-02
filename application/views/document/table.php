<table id="document-table" class="table table-striped table-bordered">
	<thead class="thead-dark">
		<th>No</th>
		<th>ID</th>
		<th>Type</th>
		<th>Name</th>
		<th>Format</th>
		<th>Size</th>
		<th>Username</th>
	</thead>
	<tbody class="table-hovered">
		<?php foreach ($docs as $i => $doc) : ?>
			<tr>
				<th><?= $i + 1 ?></th>
				<td><?= $doc['document_id'] ?></td>
				<td><?= $doc['document_type'] ?></td>
				<td><?= $doc['document_name'] ?></td>
				<td><?= $doc['document_format'] ?></td>
				<td><?= $doc['document_size'] ?></td>
				<td><?= $doc['username'] ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script>
	$(() => {
		$('#document-table').DataTable();
	});
</script>
