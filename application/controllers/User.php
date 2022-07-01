<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mod_user');
	}

	public function index()
	{
		$result['page'] = 'Home';
		$twhere = "";
		// if ($this->session->userdata('role') != 1)
		// 	$twhere = "  ";
		// $where = "";
		// if ($this->session->userdata('role') == 2) {
		// 	$where = "manager_id = '{$this->session->userdata('id')}' ";
		// } elseif ($this->session->userdata('role') == 3) {
		// 	$where = " where concat('[',REPLACE(id_users,',','],['),']') LIKE '%[{$this->session->userdata('id')}]%' ";
		// }
		// $where2 = "";
		// if ($this->session->userdata('role') == 2) {
		// 	$where2 = "manager_id = '{$this->session->userdata('id')}' ";
		// } elseif ($this->session->userdata('role') == 3) {
		// 	$where2 = " where concat('[',REPLACE(id_users,',','],['),']') LIKE '%[{$this->session->userdata('id')}]%' ";
		// }
		$id = $this->session->userdata('id');
		$result['qry'] = $this->mod_user->project_list_all();
		$result['prj_manager'] = $this->mod_user->project_list_manager($id);
		$result['prj_employe'] = $this->mod_user->project_list_employe($id);

		foreach ($result['qry'] as $row) {
			$id = $row['kd_project'];
			// var_dump($id);
			$result['tprog'] = $this->mod_user->task_list_all($id);
			$result['cprog'] = $this->mod_user->task_lists_all($id);
			$result['prod'] = $this->mod_user->produktif($id);
		}
		$result['project_list'] = $this->mod_user->project_list_total();
		$result['task_list'] = $this->mod_user->task_list_total();
		$result['data'] = $this->mod_user->project_data();
		$result['notif'] = $this->mod_user->get_notif($id);
		$result['notif2'] = $this->mod_user->get_notif($id);
		$result['count_notif'] = $this->mod_user->count_notif($id);
		$result['notif_task'] = $this->mod_user->get_notif2($id);
		$result['notif_task2'] = $this->mod_user->get_notif2($id);
		$result['count_notif2'] = $this->mod_user->count_notif2($id);
		$result['prj'] = $this->mod_user->project_list2($id);
		$result['tsk'] = $this->mod_user->task_get($id);
		// var_dump($result['prj_employe']);
		// foreach($result['prj'] as $project) {
		// 	$tgl_akhir = $project['end_date'];
		// 	$peringatan[] = date('Y-m-d', strtotime('-3 days', strtotime($tgl_akhir)));
		// }
		// var_dump($result['notif_task']);
		// $result['peringatan'] = $peringatan;
		$this->template2->views('home', $result);
	}

	public function view_project($id)
	{
		$result['page'] = 'Lihat Project';
		$result['qry'] = $this->mod_user->project_list($id);
		$result['qry2'] = $this->mod_user->project_list($id);
		// var_dump($result['qry']);
		$result['tprog'] = $this->mod_user->task_list($id);
		$result['cprog'] = $this->mod_user->task_lists($id);
		$result['prod'] = $this->mod_user->user_productivity($id);
		foreach ($result['qry'] as $row) {
			$manager_id = $row['manager_id'];
			$user_ids = $row['id_users'];
			$project_id = $row['kd_project'];
		}
		if (empty($manager_id)) {
			$result['manager'] = $this->mod_user->manager_not_set($manager_id);
		} else {
			$result['manager'] = $this->mod_user->manager($manager_id);
		}
		$result['tasks'] = $this->mod_user->task_order($id);
		$result['progress'] = $this->mod_user->progress($id);
		$result['tim_produksi'] = $this->mod_user->tim_produksi($id);
		$result['id_manager'] = $this->session->userdata('id');
		$this->template->views('view_project', $result);
	}

	public function task_list()
	{
		$result['page'] = 'Task List';
		$where = "";
		// if ($this->session->userdata('role') == 2) {
		// 	$where = " where p.manager_id = '{$this->session->userdata('id')}' ";
		// } elseif ($this->session->userdata('role') == 3) {
		// 	$where = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$this->session->userdata('id')}]%' ";
		// }
		$result['qry'] = $this->mod_user->task_list_totals();
		foreach ($result['qry'] as $row) {
			$id = $row['project_id'];
			$result['tprog'] = $this->mod_user->task_list_all($id);
			$result['cprog'] = $this->mod_user->task_lists_all($id);
			$result['prod'] = $this->mod_user->produktif($id);
		}
		$this->template->views('task_list', $result);
	}

	public function user_list()
	{
		$result['page'] = 'User';
		$result['qry'] = $this->mod_user->user_list();
		$this->template->views('user_list', $result);
	}

	public function project_list()
	{
		$result['page'] = 'List Project';
		$where = "";
		if ($this->session->userdata('role') == 2) {
			$where = " where manager_id = '{$this->session->userdata('id')}' ";
		} elseif ($this->session->userdata('role') == 3) {
			$where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$this->session->userdata('id')}]%' ";
		}
		$result['qry'] = $this->mod_user->project_list_all($where);
		foreach ($result['qry'] as $row) {
			$id = $row['id'];
			$result['tprog'] = $this->mod_user->task_list_all($id);
			$result['cprog'] = $this->mod_user->task_lists_all($id);
			$result['prod'] = $this->mod_user->produktif($id);
		}
		$this->template->views('project_list', $result);
	}

	public function new_project($id = null)
	{
		if (isset($id)) {
			$result['page'] = "Edit Project";

			$result['qry'] = $this->mod_user->get_project_id($id);
			$result['managers'] = $this->mod_user->manager_for_new_project();
			$result['employees'] = $this->mod_user->employe_for_new_project();
		} else {
			$result['page'] = "Project Baru";

			$result['managers'] = $this->mod_user->manager_for_new_project();
			$result['employees'] = $this->mod_user->employe_for_new_project();
		}
		$this->template->views('new_project', $result);
	}

	public function new_user($id = null)
	{
		if (isset($id)) {
			$result['page'] = "Edit User";

			$result['qry'] = $this->mod_user->get_user_id($id);
		} else {
			$result['page'] = "User Baru";
		}
		$this->template->views('new_user', $result);
	}

	public function view_user($id)
	{
		$result['page'] = "Lihat User";
		$result['qry'] = $this->mod_user->user_view($id);
		$this->template->views('view_user', $result);
	}

	public function view_task($id)
	{
		$result['page'] = "Lihat Task";
		$result['qry'] = $this->mod_user->view_task($id);
		$this->template->views('view_task', $result);
	}

	public function manage_progress()
	{
		$id = $this->input->get('id'); // id progress
		$pid = $this->input->get('kd_project'); // id project
		$task = $this->input->get('task'); // nama task
		if (isset($task)) {
			$tid = $this->mod_user->get_tid($id);
			foreach ($tid as $row) {
				$task_id = $row['id'];
			}
			$result['page'] = 'Tambah Produktif';

			$result['project_id'] = $pid;
			$result['task_ids'] = $task_id;
		} elseif (isset($id)) {
			$result['qry'] = $this->mod_user->manage_progress($id);
			$result['page'] = 'Edit Produktif';
		} else {
			$result['page'] = 'Tambah Produktif';
			// $result['qry'] = $this->mod_user->manage_progress($pid);
			$result['tasks'] = $this->mod_user->task_list_for_manage($pid);
			$result['project_id'] = $pid;
		}
		$this->template->views('manage_progress', $result);
	}

	public function manage_user($id)
	{
		$result['page'] = 'Penganturan Akun ';
		$result['user'] = $this->mod_user->manage_account($id);
		$this->template->views('manage_user', $result);
	}

	public function manage_task()
	{
		$id = $this->input->get('id');
		$kd_prj = $this->input->get('kd_project');
		if (isset($id)) {
			$result['page'] = 'Edit Task';

			$result['qry'] = $this->mod_user->task($id);
		} else {
			$result['page'] = 'Task Baru';
			$result['project_id'] = $kd_prj;
		}
		$this->template->views('manage_task', $result);
	}

	public function edit_user()
	{
		$id = $this->input->post('id');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$type = $this->input->post('type');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$pass_match = $this->input->post('cpass');
		if ($password == $pass_match) {
			$pass = md5($password);
		}
		$data = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'password' => $pass,
			'type' => $type
		);
		if (!empty($id)) {
			$edit = $this->mod_user->edit_user($firstname, $lastname, $email, $pass, $type, $id);
		} else {
			$edit = $this->mod_user->add_user($data);
		}
		if ($edit) {
			redirect('user/user_list');
		}
	}

	public function add_project()
	{
		$id = $this->input->post('id');
		$kd_project = $this->input->post('kd_project');
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$manager_id = $this->input->post('manager_id');
		$user_ids = $this->input->post('user_ids');
		$description = $this->input->post('description');
		$date_created = date("Y-m-d h:i:s");
		$data = array(
			'kd_project' => $kd_project,
			'name' => $name,
			'description' => $description,
			'status' => $status,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'manager_id' => $manager_id,
			'date_created' => $date_created
		);

		if ($id == null) {
			$save = $this->mod_user->add_project($data);
			// var_dump($data);
			$lasId = $this->mod_user->getLastId();
			foreach ($user_ids as $key => $value) {
				$detail = [
					'kode_project' => $lasId[0]['kd_project'],
					'id_users' => $user_ids[$key],
				];
				$this->mod_user->add_detail_project($detail);
				// var_dump($detail);
			}

			foreach ($user_ids as $key => $value) {
				$notif = array(
					'kode_project' => $lasId[0]['kd_project'],
					'id_user' => $user_ids[$key],
					'keterangan' => $this->input->post('keterangan')[$key],
					'waktu' => $this->input->post('waktu')[$key],
					'status' => '0'[$key]
				);
				$this->mod_user->add_notif($notif);
				// var_dump($notif);
			}
			$notif_manajer = array(
				'kode_project' => $lasId[0]['kd_project'],
				'id_user' => $manager_id,
				'keterangan' => 'anda memperoleh project baru',
				'waktu' => $date_created,
				'status' => 0
			);
			$this->mod_user->add_notif($notif_manajer);
			// var_dump($lasId[0]['kd_project']);
		} else {
			$save = $this->mod_user->edit_project($name, $description, $status, $start_date, $end_date, $manager_id, $id);
		}
		if ($save) {
			redirect('user/project_list');
		}
	}

	public function delete_user($id)
	{
		$delete = $this->mod_user->delete_user($id);
		if ($delete) {
			redirect('user/user_list');
		}
	}

	public function delete_project($id)
	{
		$delete = $this->mod_user->delete_project($id);
		if ($delete) {
			redirect('user/project_list');
		}
	}

	public function edit_users()
	{
		$id = $this->input->post('id');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$edit_users = $this->mod_user->edit_users($firstname, $lastname, $email, $password, $id);
		if ($edit_users) {
			redirect('user');
		}
	}
	public function add_task()
	{
		$id = $this->input->post('id');
		$project_id = $this->input->post('project_id');
		$task = $this->input->post('task');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$description = $this->input->post('description');
		$status = $this->input->post('status');
		$date_created = date("Y-m-d h:i:s");
		$data = array(
			'project_id' => $project_id,
			'task' => $task,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'description' => $description,
			'status' => $status,
			'date_created' => $date_created
		);
		if ($id == null) {
			$save = $this->mod_user->add_task($data);
			$lasId = $this->mod_user->getLastId2();
			$notif = array(
				'id_task' => $lasId[0]['id'],
				'keterangan' => 'terdapat task baru',
				'waktu' => $date_created,
			);
			$this->db->insert('notifikasi2', $notif);
		} else {
			$save = $this->mod_user->edit_task($task, $start_date, $end_date, $description, $status, $id);
		}
		if ($save) {
			redirect('user/view_project/' . $project_id);
		}
	}

	public function delete_task()
	{
		$id = $this->input->get('id');
		$pid = $this->input->get('kd_project');
		$delete = $this->mod_user->delete_task($id);
		if ($delete) {
			redirect('user/view_project/' . $pid);
		}
	}

	public function add_progress()
	{
		$id = $this->input->post('id'); // id progress
		$pid = $this->input->post('project_id'); // id project
		$tid = $this->input->post('task_id'); // id task
		$subject = $this->input->post('subject');
		$tanggal = date($this->input->post('date'));
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');
		$comment = $this->input->post('comment');
		$user_id = $this->session->userdata('id');
		$time_rendered = $end_time - $start_time;
		$data = array(
			'project_id' => $pid,
			'task_id' => $tid,
			'comment' => $comment,
			'subject' => $subject,
			'date' => $tanggal,
			'start_time' => $start_time,
			'end_time' => $end_time,
			'user_id' => $user_id,
			'time_rendered' => $time_rendered
		);
		if ($id == null) {
			$save = $this->mod_user->save_progress($data);
		} else {
			$save = $this->mod_user->edit_progress($comment, $subject, $tanggal, $start_time, $end_time, $time_rendered, $id);
		}
		if ($save) {
			redirect('user/view_project/' . $pid);
		}
	}

	public function delete_progress()
	{
		$id = $this->input->get('id');
		$pid = $this->input->get('kd_project');
		$delete = $this->mod_user->delete_progress($id);
		if ($delete) {
			redirect('user/view_project/' . $pid);
		}
	}

	public function report()
	{
		$result['page'] = 'Laporan';
		$where = "";
		if ($this->session->userdata('role') == 2) {
			$where = " where manager_id = '{$this->session->userdata('id')}' ";
		} elseif ($this->session->userdata('role') == 3) {
			$where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$this->session->userdata('id')}]%' ";
		}
		$result['qry'] = $this->mod_user->project_list_alls($where);
		// foreach ($result['qry'] as $row ) {
		// $result['tprog'] = $this->mod_user->task_list($row->id);
		// $result['cprog'] = $this->mod_user->task_lists($row->id);
		// $result['prod'] = $this->mod_user->user_productivity($row->id);
		// $result['prog'] = $result['tprog'] > 0 ? ($result['cprog']/$result['tprog']) * 100 : 0;
		// $result['prog'] = $result['prog'] > 0 ?  number_format($result['prog'],2) : $result['prog'];
		// if($row->status == 0 && strtotime(date('Y-m-d')) >= strtotime($row->start_date)):
		// if($result['prod']  > 0  || $result['cprog'] > 0)
		// 	$row->status = 2;
		// else
		// 	$row->status = 1;
		// elseif($row->status == 0 && strtotime(date('Y-m-d')) > strtotime($row->end_date)):
		// 	$row->status = 4;
		// endif;
		// $result['tasks'] = $this->mod_user->task_order($row->id);
		// $result['progress'] = $this->mod_user->progress($row->id);
		// $result['duration'] = $this->mod_user->duration($row->id);
		// if ($result['duration'] > 0) {
		// 	$dur = $this->mod_user->dur($row->id);
		// 	foreach ($dur as $row ) {
		// 		$result['durations'] = $row['duration'];
		// 	}
		// } else {
		// 	$result['durations'] = 0;
		// }
		// }
		$this->template->views('report', $result);
	}

	public function ajax_listall($nomor)
	{

		$list = $this->mod_user->get_datatablesid();
		// print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $orde) {
			// $kode_barang = preg_replace ('/[^\p{L}\p{N}]/u', '', $orde->kode_barang);
			// $nama_barang = preg_replace ('/[^\p{L}\p{N}]/u', '', $orde->nama_barang);

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $orde->id;
			$row[] = $orde->firstname;
			$row[] = $orde->lastname;

			$row[] = ' <button type="button" class="btn btn-primary "onclick="pencarian_anggota(\'' . $orde->id . '\',\'' . $orde->firstname . '\',\'' . $orde->lastname . '\',\'' . $nomor . '\')">Pilih</button>';


			$data[] = $row;
		}
		$output = array(
			"draw" => $_REQUEST['draw'],
			"recordsTotal" => $this->mod_user->count_allid(),
			"recordsFiltered" => $this->mod_user->count_filteredid(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function notif_dibaca($id)
	{
		$this->mod_user->notif_dibaca($id);
		$data = $this->db->get_where('notifikasi', ['id' => $id])->row();
		// var_dump($data->kode_project);
		redirect('User/view_project/' . $data->kode_project);
	}
}
