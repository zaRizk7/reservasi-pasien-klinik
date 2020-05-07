<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function auth()
	{
		if (!$this->session->userdata('login')) {
			$this->session->set_flashdata('failure', 'Must login to access!');
			redirect();
		}
	}

	public function auth_admin()
	{
		if (!$this->session->userdata('login') || $this->session->userdata('login')['account_type'] !== 'admin') {
			$this->session->set_flashdata('failure', 'Only admin allowed!');
			redirect();
		}
	}

	public function auth_doctor()
	{
		if (!$this->session->userdata('login') || $this->session->userdata('login')['account_type'] !== 'doctor') {
			$this->session->set_flashdata('failure', 'Only doctor allowed!');
			redirect();
		}
	}

	public function auth_patient()
	{
		if (!$this->session->userdata('login') || $this->session->userdata('login')['account_type'] !== 'doctor') {
			$this->session->set_flashdata('failure', 'Only patient allowed!');
			redirect();
		}
	}

	public function display($title, $page)
	{
		$this->load->view('layout', [
			'title' => $title,
			'page' => $page
		]);
	}
}
