<form action="" class="form-group" enctype="multipart/form-data">
	<div class="form-group">
		<label for="User">User</label>
		<select name="username" class="custom-select" id="#document-username-field">
			<option value="" selected>Username - Name</option>
			<?php foreach ($user as $usr) : ?>
				<option value="<?= $usr['username'] ?>"><?= "{$usr['username']} - {$usr['complete_name']}" ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="Document Type">Document Type</label>
		<select name="document_type" class="custom-select" id="#document-type-field">
			<option value="" selected>--Document Type--</option>
			<option value="Identity Card">Identity Card</option>
			<option value="Health Insurance">Health Insurance</option>
			<option value="Medical Card">Medical Card</option>
		</select>
	</div>
	<div class="form-group">
		<label for="File">Upload File</label>
		<div class="input-group mb-3">
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="inputGroupFile02">
				<label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
			</div>
			<div class="input-group-append">
				<span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="btn-group">
			<button class="btn btn-outline-dark" type="reset">Reset</button>
			<button class="btn btn-dark" id="save-document">Save</button>
		</div>
	</div>
</form>
<div id="document-table-container">
	<script>
		$(() => {
			$('#document-table-container').load('<?= site_url('document/table') ?>');
		})
	</script>
</div>
