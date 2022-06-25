<?php 
foreach($qry as $k){
	$task = $k['task'];
    $status = $k['status'];
    $description = $k['description'];
    $pid = $k['project_id'];
}
?>
<div class="container-fluid">
	<dl>
		<dt><b class="border-bottom border-primary">Nama Task</b></dt>
		<dd><?php echo ucwords($task) ?></dd>
	</dl>
	<dl>
		<dt><b class="border-bottom border-primary">Status</b></dt>
		<dd>
			<?php 
        	if($status == 1){
		  		echo "<span class='badge badge-secondary'>Di Tunda</span>";
        	}elseif($status == 2){
		  		echo "<span class='badge badge-primary'>Dalam Proses</span>";
        	}elseif($status == 3){
		  		echo "<span class='badge badge-success'>Selesai</span>";
        	}
        	?>
		</dd>
	</dl>
	<dl>
		<dt><b class="border-bottom border-primary">Deskripsi</b></dt>
		<dd><?php echo html_entity_decode($description) ?></dd>
	</dl>
</div>
<div class="modal-footer display p-0 m-0">
        <a type="button" class="btn btn-secondary" href="<?php echo base_url('user/view_project/'.$pid); ?>">Tutup</a>
</div>