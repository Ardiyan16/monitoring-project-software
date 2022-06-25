<?php
defined ('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mod_login');
	}

	public function index()
	{
		$result['page'] = 'Login';
		$result['system'] = 'Task Management System';
		$this->template_login->views('login', $result);
	}

	public function aksi_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$where = array(
			'email' => $email,
			'password' => md5($password)
		);
		$cek = $this->mod_login->cek_login("user", $where)->num_rows();
		if ($cek > 0) {
			$hasil = $this->mod_login->cek_login("user", $where)->row();
			$data_session = array(
				'id' => $hasil->id,
				'nama' => $hasil->firstname,
				'email' => $hasil->email,
				'role' => $hasil->type,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);
			// print_r($this->session->userdata);
			redirect(base_url('User'));
		}
		else {
			$this->session->set_flashdata('error','Username / Password salah');
			redirect(base_url('login'));
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}