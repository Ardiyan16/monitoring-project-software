<?php
if (isset($qry)) {
	foreach ($qry as $row) {
		$id = $row['id'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$type = $row['type'];
		$email = $row['email'];
	}	
}
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="<?php echo base_url('user/edit_user')?>" id="manage_user" method="post">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Nama Depan</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Nama Belakang</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<?php if($this->session->userdata('role') == 1): ?>
						<div class="form-group">
							<label for="" class="control-label">Jabatan</label>
							<select name="type" id="type" class="custom-select custom-select-sm">
								<option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Karyawan</option>
								<option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Manajer Project</option>
								<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Admin</option>
							</select>
						</div>
						<?php else: ?>
							<input type="hidden" name="type" value="3">
						<?php endif; ?>
					</div>
					<div class="col-md-6">
						
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
							<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Konfirmasi Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Simpan</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = '<?php echo base_url('user/user_list');?>'">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>