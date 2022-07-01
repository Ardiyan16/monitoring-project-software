<?php 
if (isset($qry)) {
	foreach($qry as $k){
		$id = $k['id'];
		$pid = $k['project_id'];
		$tid = $k['task_id'];
		$subject = $k['subject'];
		$date = $k['date'];
		$start_date = $k['start_time'];
		$end_date = $k['end_time'];
		$comment = $k['comment'];
	}
} elseif (isset($task_ids)) {
	$pid = $project_id;
	$tid = $task_ids;
	// echo $pid;
} else {
	$pid = $project_id;
}
?>
<div class="container-fluid">
	<form action="<?php echo base_url('user/add_progress');?>" id="manage-progress" method="post">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="project_id" value="<?= $pid ?>">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-5">
					<?php if(!isset($tid)): ?>
					 <div class="form-group">
		              <label for="" class="control-label">Nama Task</label>
		              <select class="form-control form-control-sm select2" name="task_id">
		              	<option></option>
		              	<?php 
		              	foreach($tasks as $row):
		              	?>
		              	<option value="<?php echo $row['id'] ?>" <?php echo isset($tid) && $tid == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['task']) ?></option>
		              	<?php endforeach; ?>
		              </select>
		            </div>
		            <?php else: ?>
					<input type="hidden" name="task_id" value="<?php echo isset($tid) ? $tid : '' ?>">
		            <?php endif; ?>
					<div class="form-group">
						<label for="">Subjek</label>
						<input type="text" class="form-control form-control-sm" name="subject" value="<?php echo isset($subject) ? $subject : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="">Tanggal</label>
						<input type="date" class="form-control form-control-sm" name="date" value="<?php echo isset($date) ? date("Y-m-d",strtotime($date)) : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="">Waktu Mulai</label>
						<input type="time" class="form-control form-control-sm" name="start_time" value="<?php echo isset($start_time) ? date("H:i",strtotime("2020-01-01 ".$start_time)) : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="">Waktu Selesai</label>
						<input type="time" class="form-control form-control-sm" name="end_time" value="<?php echo isset($end_time) ? date("H:i",strtotime("2020-01-01 ".$end_time)) : '' ?>" required>
					</div>
				</div>
				<div class="col-md-7">
					<div class="form-group">
						<label for="">Komentar/Deskripsi Progres</label>
						<textarea name="comment" id="" cols="30" rows="10" class="summernote form-control" required="">
							<?php echo isset($comment) ? $comment : '' ?>
						</textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 text-right justify-content-center d-flex">
			<button class="btn btn-primary mr-2">Simpan</button>
			<button class="btn btn-secondary" type="button" onclick="location.href = '<?php echo base_url('User/task_list');?>'">Batal</button>
		</div>
	</form>
</div>