<?php
foreach ($qry as $k => $v) {
    $k = $v;
    $name = $v['name'];
    $email = $v['email'];
    $type = $v['type'];
}
?>
<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
      <div class="widget-user-header bg-dark">
        <h3 class="widget-user-username"><?php echo ucwords($name) ?></h3>
        <h5 class="widget-user-desc"><?php echo $email ?></h5>
      </div>
      <div class="card-footer">
        <div class="container-fluid">
        	<dl>
        		<dt>Jabatan</dt>
        		<dd><?php 
                if ($type == "1") {
                    echo "Admin";
                } elseif ($type == "2") {
                    echo "Manajer Project";
                } else {
                    echo "Karyawan";
                }
                ?></dd>
        	</dl>
        </div>
    </div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <a type="button" class="btn btn-secondary" href="<?php echo base_url('user/user_list'); ?>">Tutup</a>
</div>