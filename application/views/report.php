  <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <b>Kemajuan Project</b>
            <div class="card-tools">
            	<button class="btn btn-flat btn-sm bg-gradient-success btn-success" id="print"><i class="fa fa-print"></i> Cetak</button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive" id="printable">
              <table class="table m-0 table-bordered" id="table_content">
                <thead> 
                  <th>#</th>
                  <th>Project</th>
                  <th>Task</th>
                  <th>Task Selesai</th>
                  <th>Durasi Pengerjaan</th>
                  <th>Kemajuan</th>
                  <th>Status</th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $stat = array("Di Tunda","Mulai","Dalam Proses","Di Tahan","Terlambat","Selesai");
                foreach ($qry as $row):
                  $name = $row->name;
                  $end_date = $row->end_date;
                  $status = $row->status;
                  $tprog = $this->mod_user->task_list($row->id);
                  // $tprog = $this->db->query("SELECT * FROM task_list where project_id = $row->id")->num_rows();
                  $cprog = $this->mod_user->task_lists($row->id);
                  $prod = $this->mod_user->user_productivity($row->id);
                  $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                  $prog = $prog > 0 ?  number_format($prog,2) : $prog;
                  if($status == 0 && strtotime(date('Y-m-d')) >= strtotime($row->start_date)):
                  if($prod  > 0  || $cprog > 0)
                    $status = 2;
                  else
                    $status = 1;
                  elseif($status == 0 && strtotime(date('Y-m-d')) > strtotime($row->end_date)):
                    $status = 4;
                  endif;
                  $tasks = $this->mod_user->task_order($row->id);
                  $progress = $this->mod_user->progress($row->id);
                  $duration = $this->mod_user->duration($row->id);
                  if ($duration > 0) {
                    $dur = $this->mod_user->dur($row->id);
                    foreach ($dur as $row ) {
                      $durations = $row['duration'];
                    }
                  } else {
                    $durations = 0;
                  }
                  ?>
                  <tr>
                      <td>
                         <?php echo $i++ ?>
                      </td>
                      <td>
                          <a>
                              <?php echo ucwords($name) ?>
                          </a>
                          <br>
                          <small>
                              Batas Waktu: <?php echo date("Y-m-d",strtotime($end_date)) ?>
                          </small>
                      </td>
                      <td class="text-center">
                      	<?php echo number_format($tprog) ?>
                      </td>
                      <td class="text-center">
                      	<?php echo number_format($cprog) ?>
                      </td>
                      <td class="text-center">
                      	<?php echo number_format($durations).' Hr/s.' ?>
                      </td>
                      <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                              </div>
                          </div>
                          <small>
                              <?php echo $prog ?>% Selesai
                          </small>
                      </td>
                      <td class="project-state">
                          <?php
                            if($stat[$status] =='Di Tunda'){
                              echo "<span class='badge badge-secondary'>{$stat[$status]}</span>";
                            }elseif($stat[$status] =='Mulai'){
                              echo "<span class='badge badge-primary'>{$stat[$status]}</span>";
                            }elseif($stat[$status] =='Dalam Proses'){
                              echo "<span class='badge badge-info'>{$stat[$status]}</span>";
                            }elseif($stat[$status] =='Di Tahan'){
                              echo "<span class='badge badge-warning'>{$stat[$status]}</span>";
                            }elseif($stat[$status] =='Terlambat'){
                              echo "<span class='badge badge-danger'>{$stat[$status]}</span>";
                            }elseif($stat[$status] =='Selesai'){
                              echo "<span class='badge badge-success'>{$stat[$status]}</span>";
                            }
                          ?>
                      </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
        
<script>
	$('#print').click(function(){
		start_load()
		var _h = $('head').clone()
		var _p = $('#printable').clone()
		var _d = "<p class='text-center'><b>Project Progress Report as of (<?php echo date("F d, Y") ?>)</b></p>"
		_p.prepend(_d)
		_p.prepend(_h)
		var nw = window.open("","","width=900,height=600")
		nw.document.write(_p.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)
	})
</script>