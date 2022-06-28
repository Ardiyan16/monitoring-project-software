<?php
if (isset($qry)) {
	foreach ($qry as $row) {
		$id = $row['id'];
		$name = $row['name'];
		$status = $row['status'];
		$start_date = $row['start_date'];
		$end_date = $row['end_date'];
		$manager_id = $row['manager_id'];
		// $user_ids = $row['user_ids'];
		$description = $row['description'];
	}
}
?>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="<?php echo base_url('user/add_project'); ?>" id="manage-project" method="post">
				<?php
				$acak = mt_rand(0, 700);
				$tanggal = date("dmY")
				?>
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<input type="hidden" name="kd_project" value="PROJECT-<?= $tanggal ?>-<?= $acak ?>">
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
							<input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d", strtotime($start_date)) : '' ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Waktu Selesai</label>
							<input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d", strtotime($end_date)) : '' ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<?php if ($this->session->userdata('role') == 1) : ?>
						<div class="col-md-12">
							<div class="form-group">
								<label for="" class="control-label">Manajer Project</label>
								<select class="form-control form-control-sm select2" name="manager_id">
									<option></option>
									<?php
									foreach ($managers as $row) :
									?>
										<option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					<?php else : ?>
						<input type="hidden" name="manager_id" value="<?php echo $this->session->userdata('id') ?>">
					<?php endif; ?>
					<br>
					
					<div class="col-md-12 input-tim" id="input-tim">
						<!-- <div class="form-group"> -->
						<!-- <label for="" class="control-label">Tim Project</label>
							<select class="form-control form-control-sm select2" multiple="multiple" name="user_ids">
								<option></option>
								<?php
								foreach ($employees as $row) :
								?>
									<option value="<?php echo $row['id'] ?>" <?php echo isset($user_ids) && in_array($row['id'], explode(',', $user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
								<?php endforeach; ?>
							</select> -->
						<!-- </div> -->
					</div>
					<button type="button" style="margin-top: 25px; margin-bottom: 20px;" class="btn-sm btn-primary" id="inputbaru">
						<i class="fa fa-plus"></i>
					</button>
					<br>
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
<div class="modal fade" id="list_anggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">List Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table id="tableanggota" class="tableanggota">
					<thead>
						<tr>
							<td>No</td>
							<td>Id User</td>
							<td>First Name</td>
							<td>Last Name</td>
							<td>opsi</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('#inputbaru').on('click', function() {
		inputbaru();
	});

	function detail_anggota(id) {
		// getDataBarang()
		$('#list_anggota').modal('show');
		table2 = $('#tableanggota').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true,
			"bDestroy": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo base_url() ?>User/ajax_listall/" + id,
				"type": "POST"
			},

			order: [1, 'asc']

		}).fnDestroy();
		table2.ajax.reload();
	}

	function runningFormatter(value, row, index) {
		return index + 1;
	}

	// $(document).on('click', '#HapusBaris', function(e) {
	// 	e.preventDefault();
	// 	if ($(this).parent().parent().find("#pencarian_anggota").val() == "") {
	// 		$(this).parent().parent().remove();
	// 		var nomor = 1;
	// 		$('.input-tim').each(function() {
	// 			$(this).find('div:nth-child(1)').html(nomor);
	// 			nomor++;
	// 		})
	// 	} else {
	// 		$(this).parent().parent().remove();
	// 		var nomor = 1;
	// 		$('.input-tim').each(function() {
	// 			$(this).find('div:nth-child(1)').html(nomor);
	// 			nomor++;
	// 		})
	// 	}
	// });

	function inputbaru() {
		var date = "<?= date("Y-m-d h:i:s") ?>";
		var nomor = $('#input-tim div').length + 1;
		// console.log(date);
		//0
		var baris = "<div class'form-group'>";
		baris += "<label " + nomor + ">" + "Tim Project" + "</label>";
		baris += "<input required  type='text' class='form-control col-md-5 firstname" + nomor + "' name='first_name[]' id='firstname' placeholder='Nama Lengkap'><button type='button' class='btn-sm btn-success' onclick='detail_anggota(" + nomor + ")' style='margin-left: 4px;'> <i class='ace-icon fa fa-search'></i></button>"
		baris += "<input type='hidden' name='user_ids[]' id='id_users' class='form-control id_users" + nomor + "' readonly>"
		baris += "<input type='hidden' name='keterangan[]' value='anda memperoleh project baru' clas='form-control keterangan"+ nomor +"'>"
		baris += "<input type='hidden' name='waktu[]' value='"+ date +"' clas='form-control waktu"+ nomor +"'>"
		// baris += "<td><button  class='btn btn-danger' id='HapusBaris'><i class='fa fa-times' style='color:white;'></i></button></td>";
		baris += "</div>"

		$('#input-tim').append(baris);
	}

	function pencarian_anggota(id, firstname, lastname, nomor) {
		$('.id_users' + nomor).val(id);
		$('.firstname' + nomor).val(firstname);
		$('.lastname' + nomor).val(lastname);
		$('#list_anggota').modal('hide');
	}
</script>