<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <?php
        $login_id = $this->session->userdata('id');
        if (isset($login_id)) : ?>
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
            </li>
        <?php endif; ?>
        <li>
            <a class="nav-link text-white" href="<?php echo base_url('user') ?>" role="button">
                <large><b><?php echo $this->session->userdata('nama') ?></b></large>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <?php if ($this->session->userdata('role') == 3) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
                    <?php if ($count_notif + $count_notif2 > 0) { ?>
                        <span class="badge badge-danger navbar-badge"><?= $count_notif + $count_notif2 ?></span>
                    <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <?php if ($count_notif + $count_notif2 == 0) { ?>
                        <span class="dropdown-item dropdown-header">Tidak Ada Notifikasi</span>
                    <?php } ?>
                    <?php if ($count_notif + $count_notif2 > 0) { ?>
                        <span class="dropdown-item dropdown-header"><?= $count_notif + $count_notif2 ?> Notifikasi</span>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <?php foreach ($notif as $ntf) { ?>
                        <a href="#tampilnotif1<?= $ntf->id ?>" data-toggle="modal" class="dropdown-item">
                            <i class="fas fa-briefcase mr-2"></i> <?= $ntf->keterangan ?>
                        </a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <?php foreach ($notif_task as $ntf) { ?>
                        <a href="#tampilnotif2<?= $ntf->id ?>" data-toggle="modal" class="dropdown-item">
                            <i class="fas fa-tasks mr-2"></i> <?= $ntf->keterangan ?>
                        </a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        <?php } ?>
        <?php if ($this->session->userdata('role') == 2) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
                    <?php if ($count_notif > 0) { ?>
                        <span class="badge badge-danger navbar-badge"><?= $count_notif ?></span>
                    <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <?php if ($count_notif == 0) { ?>
                        <span class="dropdown-item dropdown-header">Tidak Ada Notifikasi</span>
                    <?php } ?>
                    <?php if ($count_notif > 0) { ?>
                        <span class="dropdown-item dropdown-header"><?= $count_notif ?> Notifikasi</span>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <?php foreach ($notif as $ntf) { ?>
                        <a href="#tampilnotif1<?= $ntf->id ?>" data-toggle="modal" class="dropdown-item">
                            <i class="fas fa-briefcase mr-2"></i> <?= $ntf->keterangan ?>
                        </a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
                <span>
                    <div class="d-felx badge-pill">
                        <span class="fa fa-user mr-2"></span>
                        <span><b><?php echo ucwords($this->session->userdata('nama')) ?></b></span>
                        <span class="fa fa-angle-down ml-2"></span>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="<?php echo base_url('user/manage_user/' . $this->session->userdata('id')); ?>" id="manage_account"><i class="fa fa-cog"></i> Pengaturan Akun</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                </a>
            </div>
        </li>
    </ul>
</nav>
<?php foreach ($notif2 as $view) { ?>
    <div class="modal fade" id="tampilnotif1<?= $view->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notif Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?= $view->keterangan ?> yaitu <?= $view->name ?></p>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('User/notif_dibaca/' . $view->id) ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat Project</a>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php foreach ($notif_task2 as $view) { ?>
    <div class="modal fade" id="tampilnotif2<?= $view->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notif Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?= $view->keterangan ?> yaitu <?= $view->task ?> dengan rincian <?= $view->description ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php } ?>