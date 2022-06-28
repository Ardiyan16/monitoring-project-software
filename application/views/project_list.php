<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<?php if ($this->session->userdata('role') != 3) : ?>
				<div class="card-tools">
					<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="<?php echo base_url('user/new_project'); ?>"></i> Tambah project Baru</a>
				</div>
			<?php endif; ?>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="35%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th>Tanggal Mulai</th>
						<th>Tanggal Selesai</th>
						<th class="text-center">Status</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$stat = array("Di Tunda", "Mulai", "Dalam Proses", "Di Tahan", "Terlambat", "Selesai");
					foreach ($qry as $row) :
						$trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']), $trans);
						$desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
						$prog = $tprog > 0 ? ($cprog / $tprog) * 100 : 0;
						$prog = $prog > 0 ?  number_format($prog, 2) : $prog;
						if ($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])) :
							if ($prod  > 0  || $cprog > 0)
								$row['status'] = 2;
							else
								$row['status'] = 1;
						elseif ($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])) :
							$row['status'] = 4;
						endif;
					?>
						<tr>
							<th class="text-center"><?php echo $i++ ?></th>
							<td>
								<p><b><?php echo ucwords($row['name']) ?></b></p>
								<p class="truncate"><?php echo strip_tags($desc) ?></p>
							</td>
							<td><b><?php echo date("M d, Y", strtotime($row['start_date'])) ?></b></td>
							<td><b><?php echo date("M d, Y", strtotime($row['end_date'])) ?></b></td>
							<td class="text-center">
								<?php
								if ($stat[$row['status']] == 'Di Tunda') {
									echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
								} elseif ($stat[$row['status']] == 'Mulai') {
									echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
								} elseif ($stat[$row['status']] == 'Dalam Proses') {
									echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
								} elseif ($stat[$row['status']] == 'Di Tahan') {
									echo "<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
								} elseif ($stat[$row['status']] == 'Terlambat') {
									echo "<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
								} elseif ($stat[$row['status']] == 'Selesai') {
									echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
								}
								?>
							</td>
							<td class="text-center">
								<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									Aksi
								</button>
								<div class="dropdown-menu" style="">
									<a class="dropdown-item view_project" href="<?php echo base_url('User/view_project/' . $row['kd_project']) ?>" data-id="<?php echo $row['id'] ?>">Lihat</a>
									<div class="dropdown-divider"></div>
									<?php if ($this->session->userdata('role') != 3) : ?>
										<a class="dropdown-item" href="<?php echo base_url('User/new_project/' . $row['id']) ?>">Edit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_project" href="<?php echo base_url('User/delete_project/' . $row['id']) ?>">Hapus</a>
									<?php endif; ?>
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
	table p {
		margin: unset !important;
	}

	table td {
		vertical-align: middle !important
	}
</style>
<script>
	$(document).ready(function() {
		$('#list').dataTable()
	})
</script>