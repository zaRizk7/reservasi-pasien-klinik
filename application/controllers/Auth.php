<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ($this->user_model->get_user_login($username, $password)) {
			$this->session->set_userdata('username', $username);
		}
		redirect('home');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
}
