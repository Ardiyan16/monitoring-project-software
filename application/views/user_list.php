<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="<?php echo base_url('user/new_user'); ?>"><i class="fa fa-plus"></i> Tambah User Baru</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Jabatan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$type = array('',"Admin","Manager Project","Karyawan");
					foreach($qry as $row):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td><b><?php echo $type[$row['type']] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Aksi
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_user" href="<?php echo base_url('User/view_user/'.$row['id']) ?>">Lihat</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="<?php echo base_url('User/new_user/'.$row['id']); ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_user" href="<?php echo base_url('User/delete_user/'.$row['id']); ?>">Hapus</a>
		                    </div>
						</td>
					</tr>	
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	})
</script>