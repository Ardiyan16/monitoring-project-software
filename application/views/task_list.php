<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th>Task</th>
						<th>Project Dimulai</th>
						<th>Project Berakhir</th>
						<th>Status Project</th>
						<th>Status Task</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					
					$stat = array("Ditunda","Mulai","Dalam Proses","Di Tahan","Terlambat","Selesai");
					foreach($qry as $row):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
						$prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
		                $prog = $prog > 0 ?  number_format($prog,2) : $prog;
		                if($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
		                if($prod  > 0  || $cprog > 0)
		                  $row['status'] = 2;
		                else
		                  $row['status'] = 1;
		                elseif($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
		                $row['status'] = 4;
		                endif;
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td>
							<p><b><?php echo ucwords($row['name']) ?></b></p>
						</td>
						<td>
							<p><b><?php echo ucwords($row['task']) ?></b></p>
							<p class="truncate"><?php echo strip_tags($desc) ?></p>
						</td>
						<td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
						<td class="text-center">
							<?php
							  if($stat[$row['pstatus']] =='Ditunda'){
								echo "<span class='badge badge-secondary'>{$stat[$row['pstatus']]}</span>";
							}elseif($stat[$row['pstatus']] =='Mulai'){
								echo "<span class='badge badge-primary'>{$stat[$row['pstatus']]}</span>";
							}elseif($stat[$row['pstatus']] =='Dalam Proses'){
								echo "<span class='badge badge-info'>{$stat[$row['pstatus']]}</span>";
							}elseif($stat[$row['pstatus']] =='Di Tahan'){
								echo "<span class='badge badge-warning'>{$stat[$row['pstatus']]}</span>";
							}elseif($stat[$row['pstatus']] =='Terlambat'){
								echo "<span class='badge badge-danger'>{$stat[$row['pstatus']]}</span>";
							}elseif($stat[$row['pstatus']] =='Selesai'){
								echo "<span class='badge badge-success'>{$stat[$row['pstatus']]}</span>";
							  }
							?>
						</td>
						<td>
                        	<?php 
                        	if($row['status'] == 1){
						  		echo "<span class='badge badge-secondary'>Ditunda</span>";
                        	}elseif($row['status'] == 2){
						  		echo "<span class='badge badge-primary'>Dalam Proses</span>";
                        	}elseif($row['status'] == 3){
						  		echo "<span class='badge badge-success'>Selesai</span>";
                        	}
                        	?>
                        </td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Aksi
		                    </button>
			                    <div class="dropdown-menu" style="">
			                      <a class="dropdown-item new_productivity" href="<?php echo base_url("user/manage_progress?id=".$row['id']."&id=".+$row['id']."&task=".$row['task']);?>">Tambah Kegiatan</a>
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