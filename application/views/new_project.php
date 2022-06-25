<?php
if (isset($qry)) {
	foreach ($qry as $row) {
		$id = $row['id'];
		$name = $row['name'];
		$status = $row['status'];
		$start_date = $row['start_date'];
		$end_date = $row['end_date'];
		$manager_id = $row['manager_id'];
		$user_ids = $row['user_ids'];
		$description = $row['description'];
	}	
}
?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="<?php echo base_url('user/add_project');?>" id="manage-project" method="post">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Nama Project</label>
					<input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>">
				</div>
			</div>
          	<div class="col-md-6">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" id="status" class="custom-select custom-select-sm">
						<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Di Tunda</option>
						<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Di Tahan</option>
						<option value="5" <?php echo isset($status) && $status == 5 ? 'selected' : '' ?>>Selesai</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Waktu Mulai</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Waktu Selesai</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>">
            </div>
          </div>
		</div>
        <div class="row">
        	<?php if($this->session->userdata('role') == 1 ): ?>
           <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Manajer Project</label>
              <select class="form-control form-control-sm select2" name="manager_id">
              	<option></option>
              	<?php 
              	foreach($managers as $row):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endforeach; ?>
              </select>
            </div>
          </div>
      <?php else: ?>
      	<input type="hidden" name="manager_id" value="<?php echo $this->session->userdata('id') ?>">
      <?php endif; ?>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Tim Project</label>
              <select class="form-control form-control-sm select2" multiple="multiple" name="user_ids">
              	<option></option>
              	<?php 
              	foreach($employees as $row):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($user_ids) && in_array($row['id'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="" class="control-label">Deskripsi</label>
					<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
						<?php echo isset($description) ? $description : '' ?>
					</textarea>
				</div>
			</div>
		</div>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-project">Simpan</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='<?php echo base_url('User/project_list') ?>'">Batal</button>
    		</div>
    	</div>
        </form>
	</div>
</div>