<?php

/**
 *
 */
class Mod_user extends CI_Model
{

  public function project_list($id)
  {
    $this->db->select('project_list.id pid, project_list.kd_project, project_list.name, project_list.description, project_list.status, project_list.start_date, project_list.end_date, project_list.manager_id, project_list.date_created, detail_project.*');
    $this->db->from('project_list');
    $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project', 'left outer');
    $this->db->where('kd_project', $id);
    return $this->db->get()->result_array();
    // $query = $this->db->query("SELECT * FROM `project_list` JOIN `detail_project` ON `project_list`.`kd_project` = `detail_project`.`kode_project` where kd_project = " . $id)->result_array();
    // return $query;
  }

  public function project_list2($id)
  {
    $this->db->select('project_list.id pid, project_list.kd_project, project_list.name, project_list.description, project_list.status, project_list.start_date, project_list.end_date, project_list.manager_id, project_list.date_created, detail_project.*');
    $this->db->from('project_list');
    $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project', 'left outer');
    $this->db->where('project_list.status < 5');
    $this->db->where('id_users', $id);
    return $this->db->get()->result_array();
    // $query = $this->db->query("SELECT project_list.id pid, project_list.kd_project, project_list.name, project_list.description, project_list.status, project_list.start_date, project_list.end_date, project_list.manager_id, project_list.date_created, detail_project.* FROM project_list JOIN detail_project ON project_list.kd_project = detail_project.kode_project WHERE project_list.status < 5 AND detail_project.id_users = '$id';")->result_array();
    // return $query;
  }

  public function task_get($id_user)
  {
    $this->db->select('task_list.task, task_list.end_date ed, task_list.description, project_list.*, detail_project.*');
    $this->db->from('task_list');
    $this->db->join('project_list', 'task_list.project_id = project_list.kd_project');
    $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project');
    $this->db->where('id_users', $id_user);
    $this->db->where('project_list.status < 5');
    $this->db->where('task_list.status < 3');
    return $this->db->get()->result_array();
  }

  public function task_list($id)
  {
    $this->db->select('*');
    $this->db->from('task_list');
    $this->db->where('project_id', $id);
    return $this->db->get()->num_rows();
    // $query = $this->db->query("SELECT * FROM task_list where project_id = {$id}")->num_rows();
    // return $query;
  }

  public function task_lists($id)
  {
    $this->db->select('*');
    $this->db->from('task_list');
    $this->db->where('project_id', $id);
    $this->db->where('status', 3);
    return $this->db->get()->num_rows();
    // $query = $this->db->query("SELECT * FROM task_list where project_id = {$id} and status = 3")->num_rows();
    // return $query;
  }

  public function user_productivity($id)
  {
    $this->db->select('*');
    $this->db->from('user_productivity');
    $this->db->where('project_id', $id);
    return $this->db->get()->num_rows();
    // $query = $this->db->query("SELECT * FROM user_productivity where project_id = {$id}")->num_rows();
    // return $query;
  }

  public function manager($manager_id)
  {
    $query = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM user where id = {$manager_id}");
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
  }

  public function task_order($id)
  {
    $this->db->select('*');
    $this->db->from('task_list');
    $this->db->where('project_id', $id);
    $this->db->order_by('task', 'asc');
    return $this->db->get()->result_array();
    // $query = $this->db->query("SELECT * FROM task_list where project_id = {$id} order by task asc")->result_array();
    // return $query;
  }

  public function progress($id)
  {
    // $this->db->select()
    $query = $this->db->query("SELECT p.*,concat(u.firstname,' ',u.lastname) as uname,t.task FROM user_productivity p inner join user u on u.id = p.user_id inner join task_list t on t.id = p.task_id where p.project_id = '$id' order by unix_timestamp(p.date_created) desc ")->result_array();
    return $query;
  }

  public function member($user_ids)
  {
    $query = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM user where id in ($user_ids) order by concat(firstname,' ',lastname) asc")->result_array();
    return $query;
  }

  public function manager_not_set($manager_id)
  {
    return array();
  }

  public function member_not_set($user_ids)
  {
    return array();
  }

  public function project_list_all()
  {

    return $this->db->get('project_list')->result_array();
    // return $this->db->query("SELECT * FROM `project_list` JOIN `detail_project` ON `project_list`.`kd_project` = `detail_project`.`kode_project` $where ORDER BY `date_created` ASC")->result_array();
  }

  public function project_list_manager($id)
  {
    $this->db->select('*');
    $this->db->from('project_list');
    $this->db->where('manager_id', $id);
    return $this->db->get()->result_array();
  }

  public function project_list_employe($id)
  {
    $this->db->select('*');
    $this->db->from('project_list');
    $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project');
    $this->db->where('detail_project.id_users', $id);
    return $this->db->get()->result_array();
  }

  public function project_list_alls()
  {
    return $this->db->query("SELECT * FROM project_list order by name asc")->result();
  }

  public function task_list_all($id)
  {
    return $this->db->query("SELECT * FROM task_list where project_id = '$id'")->num_rows();
  }

  public function task_lists_all($id)
  {
    return $this->db->query("SELECT * FROM task_list where project_id = '$id' and status = 3")->num_rows();
  }

  public function produktif($id)
  {
    return $this->db->query("SELECT * FROM user_productivity where project_id = '$id'")->num_rows();
  }

  public function project_list_total()
  {
    // $this->db->select('*');
    // $this->db->from('project_list');
    // $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project');
    // $this->db->where($where);
    return $this->db->get('project_list')->num_rows();
    // return $this->db->query("SELECT * FROM `project_list` JOIN `detail_project` ON `project_list`.`kd_project` = `detail_project`.`kode_project` $where")->num_rows();
    // return $this->db->query("SELECT * FROM project_list $where")->num_rows();
  }

  public function task_list_total()
  {
    // $this->db->select('*');
    // $this->db->from('task_list');
    // $this->db->join('project_list', 'task_list.project_id = project_list.id');
    // $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project');
    // $this->db->where($where2);
    return $this->db->get('task_list')->num_rows();
    // return $this->db->query("SELECT * FROM `task_list` JOIN `project_list` ON `task_list`.`project_id` = `project_list`.`id` JOIN `detail_project` ON `project_list`.`kd_project` = `detail_project`.`kode_project` $where2")->num_rows();
    // return $this->db->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM task_list t inner join project_list p on p.id = t.project_id $where2")->num_rows();
  }

  public function task_list_totals()
  {
    $this->db->select('task_list.*, project_list.name, project_list.status pstatus');
    $this->db->from('task_list');
    $this->db->join('project_list', 'task_list.project_id = project_list.kd_project');
    return $this->db->get()->result_array();
    // return $this->db->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid, dp.id_users FROM task_list t inner join project_list p on p.id = t.project_id inner join detail_project dp on p.id = dp.id_users order by p.name asc")->result_array();
  }

  public function task_list_alls($id)
  {
    return $this->db->query("SELECT * FROM task_list where project_id = '$id'")->num_rows();
  }

  public function task_lists_alls($id)
  {
    return $this->db->query("SELECT * FROM task_list where project_id = '$id' and status = 3")->num_rows();
  }

  public function user_list()
  {
    return $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM user order by concat(firstname,' ',lastname) asc")->result_array();
  }

  public function manager_for_new_project()
  {
    return $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM user where type = 2 order by concat(firstname,' ',lastname) asc ")->result_array();
  }

  public function employe_for_new_project()
  {
    return $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM user where type = 3 order by concat(firstname,' ',lastname) asc ")->result_array();
  }

  public function user_view($id)
  {
    return $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM user where id = $id")->result_array();
  }

  public function manage_progress($id)
  {
    return $this->db->query("SELECT * FROM user_productivity where id = '$id'")->result_array();
  }

  public function task_list_for_manage($id)
  {
    return $this->db->query("SELECT * FROM task_list where project_id = '$id' order by task asc ")->result_array();
  }

  public function duration($id)
  {
    return $this->db->query("SELECT sum(time_rendered) as duration FROM user_productivity where project_id = '$id'")->num_rows();
  }

  public function dur($id)
  {
    return $this->db->query("SELECT sum(time_rendered) as duration FROM user_productivity where project_id = '$id'")->result_array();
  }

  public function manage_account($id)
  {
    return $this->db->query("SELECT * FROM user where id = $id")->result_array();
  }

  public function task($id)
  {
    return $this->db->query("SELECT * FROM task_list where id = $id")->result_array();
  }

  public function add_user($data)
  {
    return $this->db->insert('user', $data);
  }

  public function add_notif($notif)
  {
    return $this->db->insert('notifikasi', $notif);
  }

  public function add_detail_project($detail)
  {
    return $this->db->insert('detail_project', $detail);
  }

  public function edit_user($firstname, $lastname, $email, $pass, $type, $id)
  {
    return $this->db->query("UPDATE user SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$pass',`type`='$type' WHERE `id` = '$id'");
  }

  public function edit_users($firstname, $lastname, $email, $password, $id)
  {
    return $this->db->query("UPDATE user SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$password' WHERE `id` = '$id'");
  }

  public function add_project($data)
  {
    return $this->db->insert('project_list', $data);
  }

  public function edit_project($name, $description, $status, $start_date, $end_date, $manager_id, $id)
  {
    return $this->db->query("UPDATE project_list SET name = '$name', description = '$description', status = '$status', start_date = '$start_date', end_date = '$end_date', manager_id = '$manager_id' WHERE id = '$id'");
  }

  public function get_user_id($id)
  {
    return $this->db->query("SELECT * FROM user WHERE id = $id")->result_array();
  }

  public function get_project_id($id)
  {
    return $this->db->query("SELECT * FROM project_list where id = $id")->result_array();
  }

  public function delete_user($id)
  {
    return $this->db->query("DELETE FROM user WHERE id = '$id'");
  }

  public function delete_project($id)
  {
    return $this->db->query("DELETE FROM project_list WHERE id = '$id'");
  }

  public function add_task($data)
  {
    return $this->db->insert('task_list', $data);
  }

  public function edit_task($task, $start_date, $end_date, $description, $status, $id)
  {
    return $this->db->query("UPDATE task_list SET `task`='$task',`start_date`='$start_date',`end_date`='$end_date',`description`='$description',`status`='$status' WHERE `id` = '$id'");
  }

  public function delete_task($id)
  {
    return  $this->db->query("DELETE FROM task_list WHERE id = '$id'");
  }

  public function view_task($id)
  {
    return $this->db->query("SELECT * FROM task_list where id = $id")->result_array();
  }

  public function get_tid($id)
  {
    $this->db->select('task_list.id, task_list.project_id, task_list.task, task_list.description, task_list.status, task_list.date_created, project_list.kd_project');
    $this->db->from('task_list');
    $this->db->join('project_list', 'task_list.project_id = project_list.kd_project');
    $this->db->where('task_list.id', $id);
    return $this->db->get()->result_array();
    // return $this->db->query("SELECT * FROM task_list WHERE task = '$task'")->result_array();
  }

  public function save_progress($data)
  {
    return $this->db->insert('user_productivity', $data);
  }

  public function edit_progress($comment, $subject, $tanggal, $start_time, $end_time, $time_rendered, $id)
  {
    return $this->db->query("UPDATE user_productivity SET `comment`='$comment',`subject`='$subject',`date`='$tanggal',`start_time`='$start_time',`end_time`='$end_time',`time_rendered`='$time_rendered' WHERE `id` = '$id'");
  }

  public function delete_progress($id)
  {
    return  $this->db->query("DELETE FROM user_productivity WHERE id = '$id'");
  }

  public function project_data()
  {
    return $this->db->query("SELECT MONTH(date_created) AS month, COUNT(date_created) AS date_created FROM project_list GROUP BY MONTH(date_created)")->result();
  }



  // var $barang = 'barang';
  var $column_orderid = array('a.id', 'a.firstname', 'a.lastname', 'a.email', null); //set column field database for datatable orderable
  var $column_searchid = array('a.id', 'a.firstname', 'a.lastname', 'a.email'); //set column field database for datatable searchable just title , author , category are searchable
  var $orderid = array('a.id' => 'asc'); // default order
  public function get_datatablesid()
  {
    $this->_get_datatables_queryid();
    //	$this->db->where('orde_sungai',$id);

    if ($_REQUEST['length'] != -1) {
      $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  private function _get_datatables_queryid()
  {
    $this->db->select('*');
    $this->db->from("user a");
    $this->db->where('type', 3);
    // $this->db->join('jenis c', 'a.id_jenis=c.id_jenis', 'left outer');
    // $this->db->join('merek b', 'a.id_merek=b.id_merek', 'left outer');
    $i = 0;


    foreach ($this->column_searchid as $item) {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
          // $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_searchid) - 1 == $i); //last loop
        // $this->db->group_end(); //close bracket


      }

      $i++;
    }

    if (isset($_REQUEST['order'])) {
      $this->db->order_by($this->column_orderid[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
    } else if (isset($this->orderid)) {
      $order = $this->orderid;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function count_filteredid()
  {
    $this->_get_datatables_queryid();
    //$this->db->where('orde_sungai',$id);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function count_allid()
  {
    $this->db->from('user');
    $this->db->where('type', 3);
    return $this->db->count_all_results();
  }

  function getLastId()
  {
    $sql = $this->db->select('kd_project');
    $sql = $this->db->from('project_list');
    $sql = $this->db->order_by('id', 'desc');
    $sql = $this->db->limit(1);
    $sql = $this->db->get();

    return $sql->result_array();
  }

  function getLastId2()
  {
    $sql = $this->db->select('id');
    $sql = $this->db->from('task_list');
    $sql = $this->db->order_by('id', 'desc');
    $sql = $this->db->limit(1);
    $sql = $this->db->get();

    return $sql->result_array();
  }

  public function get_notif($id)
  {
    $this->db->select('notifikasi.*, project_list.name');
    $this->db->from('notifikasi');
    $this->db->join('project_list', 'notifikasi.kode_project = project_list.kd_project');
    $this->db->where('id_user', $id);
    $this->db->where('notifikasi.status', 0);
    return $this->db->get()->result();
  }

  public function get_notif2($id)
  {
    $this->db->select('notifikasi2.*, task_list.id tid, task_list.task, task_list.status, task_list.description');
    $this->db->from('notifikasi2');
    $this->db->join('task_list', 'notifikasi2.id_task = task_list.id');
    $this->db->join('project_list', 'task_list.project_id = project_list.kd_project');
    $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project');
    $this->db->where('task_list.status', 1);
    $this->db->where('detail_project.id_users', $id);
    return $this->db->get()->result();
  }

  public function count_notif($id)
  {
    $this->db->select('COUNT(id) as jml');
    $this->db->from('notifikasi');
    $this->db->where('id_user', $id);
    $this->db->where('status', 0);
    return $this->db->get()->row()->jml;
  }

  public function count_notif2($id)
  {
    $this->db->select('COUNT(id_task) as jml');
    $this->db->from('notifikasi2');
    $this->db->join('task_list', 'notifikasi2.id_task = task_list.id');
    $this->db->join('project_list', 'task_list.project_id = project_list.kd_project');
    $this->db->join('detail_project', 'project_list.kd_project = detail_project.kode_project');
    $this->db->where('task_list.status', 1);
    $this->db->where('detail_project.id_users', $id);
    return $this->db->get()->row()->jml;
  }

  public function notif_dibaca($id)
  {
    $this->db->query("UPDATE `notifikasi` SET `status`= '1' WHERE notifikasi.id ='$id'");
  }

  public function tim_produksi($id)
  {
    $this->db->select('*');
    $this->db->from('detail_project');
    $this->db->join('user', 'user.id = detail_project.id_users');
    $this->db->where('kode_project', $id);
    return $this->db->get()->result();
  }

  // public function detail_project($id)
  // {
  //   $this->db->select('*');
  //   $this->db->from('detail_project');
  //   $this->db->where('kode_project', $id);
  //   return $this->db->get()->result_array();
  // }

  // public function notif_manajer()
  // {
  //   $this
  // }
}
