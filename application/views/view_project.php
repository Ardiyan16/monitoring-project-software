<?php
$stat = array("Di Tunda", "Mulai", "Dalam Proses", "Di Tahan", "Terlambat", "Selesai");
foreach ($qry as $k => $v) {
	$k = $v;
	$status = $v['status'];
	$start_date = $v['start_date'];
	$end_date = $v['end_date'];
	$name = $v['name'];
	$description = $v['description'];
	// $user_ids = $v['user_ids'];
	$manager_id = $v['manager_id'];
	$id = $v['pid'];
	$kd_prj = $v['kd_project'];
}
$prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
$prog = $prog > 0 ?  number_format($prog, 2) : $prog;
if ($status == 0 && strtotime(date('Y-m-d')) >= strtotime($start_date)) :
	if ($prod  > 0  || $cprog > 0)
		$status = 2;
	else
		$status = 1;
elseif ($status == 0 && strtotime(date('Y-m-d')) > strtotime($end_date)) :
	$status = 4;
endif;
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-12">
			<div class="callout callout-info">
				<div class="col-md-12">
					<div class="row">
						<div class="col-sm-6">
							<dl>
								<dt><b class="border-bottom border-primary">Nama Project</b></dt>
								<dd><?php echo ucwords($name) ?></dd>
								<dt><b class="border-bottom border-primary">Deskripsi</b></dt>
								<dd><?php echo html_entity_decode($description) ?></dd>
							</dl>
						</div>
						<div class="col-md-6">
							<dl>
								<dt><b class="border-bottom border-primary">Tanggal Mulai</b></dt>
								<dd><?php echo date("F d, Y", strtotime($start_date)) ?></dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">Tanggal Selesai</b></dt>
								<dd><?php echo date("F d, Y", strtotime($end_date)) ?></dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">Status</b></dt>
								<dd>
									<?php
									if ($stat[$status] == 'Di Tunda') {
										echo "<span class='badge badge-secondary'>{$stat[$status]}</span>";
									} elseif ($stat[$status] == 'Mulai') {
										echo "<span class='badge badge-primary'>{$stat[$status]}</span>";
									} elseif ($stat[$status] == 'Dalam Proses') {
										echo "<span class='badge badge-info'>{$stat[$status]}</span>";
									} elseif ($stat[$status] == 'DI Tahan') {
										echo "<span class='badge badge-warning'>{$stat[$status]}</span>";
									} elseif ($stat[$status] == 'Terlambat') {
										echo "<span class='badge badge-danger'>{$stat[$status]}</span>";
									} elseif ($stat[$status] == 'Selesai') {
										echo "<span class='badge badge-success'>{$stat[$status]}</span>";
									}
									?>
								</dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">Manager Project</b></dt>
								<dd>
									<?php
									if (!empty($manager_id)) {
										foreach ($manager as $row) { ?>
											<div class="d-flex align-items-center mt-1">
												<b><?php echo ucwords($row['name']) ?></b>
											</div>
										<?php
										}
									} else { ?>
										<small><i>Manager Deleted from Database</i></small>
									<?php } ?>
								</dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<span><b>Tim Produksi:</b></span>
					<div class="card-tools">
						<!-- <button class="btn btn-primary bg-gradient-primary btn-sm" type="button" id="manage_team">Manage</button> -->
					</div>
				</div>
				<div class="card-body">
					<ul class="users-list clearfix">
						<?php
						if (!empty($user_ids)) :
							foreach ($members as $row) :
						?>
								<li>
									<a class="users-list-name" href="javascript:void(0)"><?php echo ucwords($row['name']) ?></a>
									<!-- <span class="users-list-date">Today</span> -->
								</li>
						<?php
							endforeach;
						endif;
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<span><b>Task List:</b></span>
					<?php if ($this->session->userdata('role') == 1) : ?>
						<div class="card-tools">
							<a class="btn btn-primary bg-gradient-primary btn-sm" type="button" id="new_task" href="<?php echo base_url("user/manage_task?kd_project=" . $kd_prj); ?>"><i class="fa fa-plus"></i> Task Baru</a>
						</div>
					<?php endif; ?>
					<?php if ($this->session->userdata('role') == 2) : ?>
						<div class="card-tools">
							<a class="btn btn-primary bg-gradient-primary btn-sm" type="button" id="new_task" href="<?php echo base_url("user/manage_task?kd_project=" . $kd_prj); ?>"><i class="fa fa-plus"></i> Task Baru</a>
						</div>
					<?php endif; ?>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-condensed m-0 table-hover">
							<colgroup>
								<col width="5%">
								<col width="25%">
								<col width="30%">
								<col width="15%">
								<col width="15%">
							</colgroup>
							<thead>
								<th>#</th>
								<th>Task</th>
								<th>Deskripsi</th>
								<th>Status</th>
								<th>Aksi</th>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($tasks as $row) :
									$trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
									unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
									$desc = strtr(html_entity_decode($row['description']), $trans);
									$desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
								?>
									<tr>
										<td class="text-center"><?php echo $i++ ?></td>
										<td class=""><b><?php echo ucwords($row['task']) ?></b></td>
										<td class="">
											<p class="truncate"><?php echo strip_tags($desc) ?></p>
										</td>
										<td>
											<?php
											if ($row['status'] == 1) {
												echo "<span class='badge badge-secondary'>Di Tunda</span>";
											} elseif ($row['status'] == 2) {
												echo "<span class='badge badge-primary'>Dalam Proses</span>";
											} elseif ($row['status'] == 3) {
												echo "<span class='badge badge-success'>Selesai</span>";
											}
											?>
										</td>
										<td class="text-center">
											<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
												Aksi
											</button>
											<div class="dropdown-menu" style="">
												<a class="dropdown-item view_task" href="<?php echo base_url('user/view_task/' . $row['id']); ?>">Lihat</a>
												<div class="dropdown-divider"></div>
												<?php if ($this->session->userdata('role') != 3) : ?>
													<a class="dropdown-item edit_task" href="<?php echo base_url("user/manage_task?id=" . $row['id'] . "&pid=" . +$id); ?>">Edit</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item delete_task" href="<?php echo base_url("user/delete_task?id=" . $row['id'] . "&pid=" . +$id); ?>">Hapus</a>
												<?php endif; ?>
											</div>
										</td>
									</tr>
								<?php
								endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<b>Member Progres/Kegiatan</b>
					<div class="card-tools">
						<a class="btn btn-primary bg-gradient-primary btn-sm" type="button" id="new_productivity" href="<?php echo base_url('user/manage_progress?pid=' . $id); ?>"><i class="fa fa-plus"></i> Produktif Baru</a>
					</div>
				</div>
				<div class="card-body">
					<?php
					foreach ($progress as $row) :
					?>
						<div class="post">

							<div class="user-block">
								<?php if ($this->session->userdata('id') == $row['user_id']) : ?>
									<span class="btn-group dropleft float-right">
										<span class="btndropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
											<i class="fa fa-ellipsis-v"></i>
										</span>
										<div class="dropdown-menu">
											<a class="dropdown-item manage_progress" href="<?php echo base_url("user/manage_progress?id=" . $row['id'] . "&pid=" . +$id); ?>">Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_progress" href="<?php echo base_url("user/delete_progress?id=" . $row['id'] . "&pid=" . +$id); ?>">Hapus</a>
										</div>
									</span>
								<?php endif; ?>
								<span class="username">
									<a href="#"><?php echo ucwords($row['uname']) ?>[ <?php echo ucwords($row['task']) ?> ]</a>
								</span>
								<span class="description">
									<span class="fa fa-calendar-day"></span>
									<span><b><?php echo date('M d, Y', strtotime($row['date'])) ?></b></span>
									<span class="fa fa-user-clock"></span>
									<span>Mulai: <b><?php echo date('h:i A', strtotime($row['date'] . ' ' . $row['start_time'])) ?></b></span>
									<span> | </span>
									<span>Selesai: <b><?php echo date('h:i A', strtotime($row['date'] . ' ' . $row['end_time'])) ?></b></span>
								</span>



							</div>
							<!-- /.user-block -->
							<div>
								<?php echo html_entity_decode($row['comment']) ?>
							</div>

							<p>
								<!-- <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a> -->
							</p>
						</div>
						<div class="post clearfix"></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.users-list>li img {
		border-radius: 50%;
		height: 67px;
		width: 67px;
		object-fit: cover;
	}

	.users-list>li {
		width: 33.33% !important
	}

	.truncate {
		-webkit-line-clamp: 1 !important;
	}
</style>