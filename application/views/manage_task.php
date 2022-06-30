<?php
if (isset($qry)) {
	foreach ($qry as $k) {
		$id = $k['id'];
		$pid = $k['project_id'];
		$task = $k['task'];
		$start_date = $k['start_date'];
		$end_date = $k['end_date'];
		$description = $k['description'];
		$status = $k;
	}
} else {
	$pid = $project_id;
}
?>
<div class="container-fluid">
	<form action="<?php echo base_url('user/add_task'); ?>" id="manage_task" method="post">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="project_id" value="<?php echo isset($pid) ? $pid : '' ?>">
		<div class="form-group">
			<label for="">Nama Task</label>
			<input type="text" class="form-control form-control-sm" name="task" value="<?php echo isset($task) ? $task : '' ?>" required>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control-label">Waktu Mulai</label>
				<input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d", strtotime($start_date)) : '' ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="" class="control-label">Waktu Selesai</label>
				<input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d", strtotime($end_date)) : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="">Deskripsi</label>
			<textarea name="description" id="description" cols="30" rows="10" class="summernote form-control">
				<?php echo isset($description) ? $description : '' ?>
			</textarea>
		</div>
		<div class="form-group">
			<label for="">Status</label>
			<select name="status" id="status" class="custom-select custom-select-sm">
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Di Tunda</option>
				<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Dalam Proses</option>
				<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Selesai</option>
			</select>
		</div>
		<div class="col-lg-12 text-right justify-content-center d-flex">
			<button class="btn btn-primary mr-2">Simpan</button>
			<button class="btn btn-secondary" type="button" onclick="location.href = '<?php echo base_url('User/task_list'); ?>'">Batal</button>
		</div>
	</form>
</div>