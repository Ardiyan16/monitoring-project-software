  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="<?php echo base_url('user'); ?>" class="brand-link">
        <?php if($this->session->userdata('role') == 1): ?>
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
        <?php else: ?>
        <h3 class="text-center p-0 m-0"><b>USER</b></h3>
        <?php endif; ?>

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="<?php echo base_url('user'); ?>" <?php if ($page == 'Home') { echo 'class="nav-link nav-home active"'; } else { echo 'class="nav-link nav-home"'; }?>>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="#" <?php if ($page == 'Lihat Project') { echo 'class="nav-link nav-edit_project nav-view_project active"'; } elseif ($page == 'Edit Project') { echo 'class="nav-link nav-edit_project nav-view_project active"'; } elseif ($page == 'Project Baru') { echo 'class="nav-link nav-edit_project nav-view_project active"'; } elseif ($page == 'List Project') { echo 'class="nav-link nav-edit_project nav-view_project active"'; } else { echo 'class="nav-link nav-edit_project nav-view_project"'; }?>>
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Project
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($this->session->userdata('role') != 3): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('user/new_project'); ?>" class="nav-link nav-new_project tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Tambah Baru</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="<?php echo base_url('user/project_list')?>" class="nav-link nav-project_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li> 
          <li class="nav-item">
                <a href="<?php echo base_url('user/task_list'); ?>" <?php if ($page == 'Task List') { echo 'class="nav-link nav-task_list active"'; } else { echo 'class="nav-link nav-task_list"'; }?>>
                  <i class="fas fa-tasks nav-icon"></i>
                  <p>Task</p>
                </a>
          </li>
          <?php if($this->session->userdata('role') != 3): ?>
           <li class="nav-item">
                <a href="<?php echo base_url('user/report'); ?>" <?php if ($page == 'Laporan') { echo 'class="nav-link nav-reports active"'; } else { echo 'class="nav-link nav-reports"'; }?>>
                  <i class="fas fa-th-list nav-icon"></i>
                  <p>Laporan</p>
                </a>
          </li>
          <?php endif; ?>
          <?php if($this->session->userdata('role') == 1): ?>
          <li class="nav-item">
            <a href="#" <?php if ($page == 'User') { echo 'class="nav-link nav-edit_user active"'; } elseif ($page == 'User Baru') { echo 'class="nav-link nav-edit_user active"'; } elseif ($page == 'Edit User') { echo 'class="nav-link nav-edit_user active"'; } elseif ($page == 'Lihat User') { echo 'class="nav-link nav-edit_user active"'; } else { echo 'class="nav-link nav-edit_user"'; }?>>
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('user/new_user'); ?>" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Tambah Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('user/user_list'); ?>" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        </ul>
      </nav>
    </div>
  </aside>