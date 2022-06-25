<?php

  /**
   *
   */
  class Mod_user extends CI_Model
  {
     
    public function project_list($id)
      {
        $query = $this->db->query("SELECT * FROM project_list where id = ".$id)->result_array();
        return $query;
      }
      
      public function task_list($id)
      {
        $query = $this->db->query("SELECT * FROM task_list where project_id = {$id}")->num_rows();
        return $query;
      }
      
      public function task_lists($id)
      {
        $query = $this->db->query("SELECT * FROM task_list where project_id = {$id} and status = 3")->num_rows();
        return $query;
      }
      
      public function user_productivity($id)
      {
        $query = $this->db->query("SELECT * FROM user_productivity where project_id = {$id}")->num_rows();
        return $query;
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
        $query = $this->db->query("SELECT * FROM task_list where project_id = {$id} order by task asc")->result_array();
        return $query;
      }
      
      public function progress($id)
      {
        $query = $this->db->query("SELECT p.*,concat(u.firstname,' ',u.lastname) as uname,t.task FROM user_productivity p inner join user u on u.id = p.user_id inner join task_list t on t.id = p.task_id where p.project_id = $id order by unix_timestamp(p.date_created) desc ")->result_array();
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
      
      public function project_list_all($where)
      {
        return $this->db->query("SELECT * FROM project_list $where order by date_created asc")->result_array();
      }

      public function project_list_alls($where)
      {
        return $this->db->query("SELECT * FROM project_list $where order by name asc")->result();
      }
      
      public function task_list_all($id)
      {
        return $this->db->query("SELECT * FROM task_list where project_id = $id")->num_rows();
      }
      
      public function task_lists_all($id)
      {
        return $this->db->query("SELECT * FROM task_list where project_id = $id and status = 3")->num_rows();
      }
      
      public function produktif($id)
      {
        return $this->db->query("SELECT * FROM user_productivity where project_id = $id")->num_rows();
      }
      
      public function project_list_total($where)
      {
        return $this->db->query("SELECT * FROM project_list $where")->num_rows();
      }
      
      public function task_list_total($where2)
      {
        return $this->db->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM task_list t inner join project_list p on p.id = t.project_id $where2")->num_rows();
      }
      
      public function task_list_totals($where)
      {
        return $this->db->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM task_list t inner join project_list p on p.id = t.project_id $where order by p.name asc")->result_array();
      }
      
      public function task_list_alls($id)
      {
        return $this->db->query("SELECT * FROM task_list where project_id = $id")->num_rows();
      }
      
      public function task_lists_alls($id)
      {
        return $this->db->query("SELECT * FROM task_list where project_id = $id and status = 3")->num_rows();
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
        return $this->db->query("SELECT * FROM user_productivity where id = $id")->result_array();
      }
      
      public function task_list_for_manage($pid)
      {
        return $this->db->query("SELECT * FROM task_list where project_id = $pid order by task asc ")->result_array();
      }
      
      public function duration($id)
      {
        return $this->db->query("SELECT sum(time_rendered) as duration FROM user_productivity where project_id = $id")->num_rows();
      }

      public function dur($id)
      {
        return $this->db->query("SELECT sum(time_rendered) as duration FROM user_productivity where project_id = $id")->result_array();
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

      public function edit_user($firstname,$lastname,$email,$pass,$type,$id)
      {
        return $this->db->query("UPDATE user SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$pass',`type`='$type' WHERE `id` = '$id'");
      }

      public function edit_users($firstname,$lastname,$email,$password,$id)
      {
        return $this->db->query("UPDATE user SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$password' WHERE `id` = '$id'");
      }

      public function add_project($data)
      {
        return $this->db->insert('project_list', $data);
      }

      public function edit_project($name,$description,$status,$start_date,$end_date,$manager_id,$user_ids,$id)
      {
        return $this->db->query("UPDATE project_list SET name = '$name', description = '$description', status = '$status', start_date = '$start_date', end_date = '$end_date', manager_id = '$manager_id', user_ids = '$user_ids' WHERE id = '$id'");
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

      public function edit_task($task,$description,$status,$id)
      {
        return $this->db->query("UPDATE task_list SET `task`='$task',`description`='$description',`status`='$status' WHERE `id` = '$id'");
      }

      public function delete_task($id)
      {
        return  $this->db->query("DELETE FROM task_list WHERE id = '$id'");
      }

      public function view_task($id)
      {
        return $this->db->query("SELECT * FROM task_list where id = $id")->result_array();
      }

      public function get_tid($task)
      {
        return $this->db->query("SELECT * FROM task_list WHERE task = '$task'")->result_array();
      }

      public function save_progress($data)
      {
        return $this->db->insert('user_productivity', $data);
      }
      
      public function edit_progress($comment,$subject,$tanggal,$start_time,$end_time,$time_rendered,$id)
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
  }
?>