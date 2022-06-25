    <div class="col-12">
        <div class="card">
            <div class="card-body">
                Selamat Datang <?php echo $this->session->userdata('nama') ?>!
            </div>
        </div>
    </div>
    <hr>
<div class="row">
        <div class="col-md-8">
        <div class="card card-outline card-success">
          <div class="card-header">
            <b>Kemajuan Project</b>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0 table-hover">
                <colgroup>
                  <col width="5%">
                  <col width="30%">
                  <col width="35%">
                  <col width="15%">
                  <col width="15%">
                </colgroup>
                <thead>
                  <th>#</th>
                  <th>Project</th>
                  <th>Kemajuan</th>
                  <th>Status</th>
                  <th></th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $stat = array("Di Tunda","Mulai","Dalam Proses","Di Tahan","Terlambat","Selesai");
                foreach($qry as $row):
                  $prog= 0;
                  $tprog = $this->mod_user->task_list_all($row['id']);
			            $cprog = $this->mod_user->task_lists_all($row['id']);
			            $prod = $this->mod_user->produktif($row['id']);
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
                      <td>
                         <?php echo $i++ ?>
                      </td>
                      <td>
                          <a>
                              <?php 
                              echo ucwords($row['name']) ?>
                          </a>
                          <br>
                          <small>
                              Batas Waktu: <?php 
                              echo date("Y-m-d",strtotime($row['end_date'])) ?>
                          </small>
                      </td>
                      <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                              </div>
                          </div>
                          <small>
                              <?php 
                              echo $prog ?>% Selesai
                          </small>
                      </td>
                      <td class="project-state">
                          <?php
                            if($stat[$row['status']] =='Di Tunda'){
                              echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Mulai'){
                              echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Dalam Proses'){
                              echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Di Tahan'){
                              echo "<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Terlambat'){
                              echo "<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Selesai'){
                              echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                            }
                          ?>
                          </td>
                      <td>
                        <a class="btn btn-primary btn-sm" href="<?php echo base_url('User/view_project/'.$row['id']) ?>">
                              <i class="fas fa-folder">
                              </i>
                              Lihat
                        </a>
                      </td>
                  </tr>
                <?php 
            endforeach; ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
          <div class="row">
          <div class="col-12 col-sm-6 col-md-12">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php 
                echo $project_list;
                ?></h3>
                <p>Total Project</p>
              </div>
              <div class="icon">
                <i class="fa fa-layer-group"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-12">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php 
                echo $task_list;
                ?></h3>
                <p>Total Task</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks"></i>
              </div>
            </div>
          </div>
      </div>
        </div>
      </div>
      <!-- <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Total Projek per Bulan</h5>
                </div>
              </div>
            </div>
            <div class="card-body"> -->
              <!-- Chart -->
              <!-- <div class="chart">
                <canvas id="chart-bars" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div> -->
  <!-- <script>
 
var BarsChart = (function() {

//
// Variables
//

var $chart = $('#chart-bars');


//
// Methods
//

// Init chart
function initChart($chart) {

  // Create chart
  var project = new Chart($chart, {
    type: 'bar',
    data: {
      labels: [
        <?php 
          // foreach ($data as $row) : ?>
            '<?php 
            // echo get_month($row->month); ?>',
        <?php 
      // endforeach; ?>
      ],
      datasets: [{
        label: 'Projek',
        data: [
          <?php 
            // foreach ($data as $row) : ?>
            '<?php 
            // echo $row->date_created; ?>',
          <?php 
        // endforeach; ?>
        ]
      }]
    }
  });

  // Save to jQuery object
  $chart.data('chart', project);
}


// Init chart
if ($chart.length) {
  initChart($chart);
}

})
  </script> -->