<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('email');
		$this->load->model('user_model');
		$this->load->model('patient_model');
		$this->load->model('doctor_model');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$this->display('ServeHealth - The Clinic Reservation Service', 'home/index');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$result = $this->user_model->login($username, $password);
		if ($result) {
			if ($result['account_type'] === 'doctor') {
				$doctor_data = $this->doctor_model->read_by_username($username);
				$this->session->set_userdata('login', [
					'username' => $result['username'],
					'account_type' => $result['account_type'],
					'doctor_id' => $doctor_data['id']
				]);
			} else {
				$this->session->set_userdata('login', [
					'username' => $result['username'],
					'account_type' => $result['account_type']
				]);
			}
			$this->session->set_flashdata('success', "Login successful! Welcome back, {$username}!");
		} else {
			$this->session->set_flashdata('failure', 'Login Failed! Incorrect username or password');
		}
	}

	public function fetch($role = null)
	{
		$data = [
			'account_type' => $role
		];
		if ($role === 'patient') {
			$data['users'] = $this->patient_model->read_patient();
		} elseif ($role === 'doctor') {
			$data['users'] = $this->doctor_model->read_doctor();
		} else {
			$data['users'] = $this->admin_model->read_admin();
		}
		echo json_encode($data);
	}

	public function fetch_one($role = null, $username = null)
	{
		$this->auth_admin();
		if ($role === 'patient') {
			$data = $this->patient_model->read_by_username($username);
		} elseif ($role === 'doctor') {
			$data = $this->doctor_model->read_by_username($username);
		} else {
			$data = $this->admin_model->read_by_username($username);
		}
		echo json_encode($data);
	}

	public function fetch_login_data()
	{
		if (!$this->session->userdata('login')) {
			$this->session->set_flashdata('failure', 'Not allowed, please login!');
			redirect();
		}
		if ($this->session->userdata('login')['account_type'] ===  'doctor') {
			echo json_encode($this->doctor_model->read_by_username($this->session->userdata('login')['username']));
		} elseif ($this->session->userdata('login')['account_type'] ===  'admin') {
			echo json_encode($this->admin_model->read_by_username($this->session->userdata('login')['username']));
		} else {
			echo json_encode($this->patient_model->read_by_username($this->session->userdata('login')['username']));
		}
	}

	private function username_exist($username = null)
	{
		return $this->user_model->read_by_username($username) !== null;
	}

	private function user_validation()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[10]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('complete_name', 'Complete name', 'required|max_length[40]');
		$this->form_validation->set_rules('place_of_birth', 'Place of birth', 'required|max_length[20]');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required');
		$this->form_validation->set_rules('phone_number', 'Phone number', 'required|min_length[10]|max_length[20]|regex_match[/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/]');
		$this->form_validation->set_rules('email', 'E-Mail', 'required|max_length[100]|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required|min_length[5]|max_length[50]');
	}

	public function register()
	{
		$account_type = $this->input->post('account_type');
		$this->user_validation();
		if ($account_type === 'doctor') {
			$this->form_validation->set_rules('doctor_type', 'Doctor type', 'required|max_length[10]');
			$this->form_validation->set_rules('doctor_room', 'Doctor room', 'required|max_length[10]');
		}
		$username = $this->input->post('username');
		$data = [
			'username' => $username,
			'password' => $this->input->post('password'),
			'account_type' => $account_type,
			'complete_name' => $this->input->post('complete_name'),
			'place_of_birth' => $this->input->post('place_of_birth'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'account_created' => date('Y-m-d H:i:s')
		];
		if ($this->form_validation->run()) {
			if ($this->username_exist($username)) {
				echo json_encode(['error' => [
					'username' => 'Username already exists'
				]]);
				exit();
			}
			if ($this->user_model->create($data)) {
				switch ($account_type) {
					case 'patient':
						$this->patient_model->create([
							'username' => $username,
							'patient_id' => $this->patient_model->generate_patient_id()
						]);
						break;
					case 'admin':
						$this->admin_model->create([
							'username' => $username,
							'admin_id' => $this->admin_model->generate_admin_id()
						]);
						break;
					case 'doctor':
						$this->doctor_model->create([
							'username' => $username,
							'doctor_id' => $this->doctor_model->generate_doctor_id(),
							'doctor_type' => $this->input->post('doctor_type'),
							'doctor_room' => $this->input->post('doctor_room')
						]);
						break;
				};
				echo json_encode([
					'success' => 'Registered successfully!',
					'data' => [
						'username' => $username,
						'password' => $this->input->post('password')
					]
				]);
			} else {
				echo json_encode(['failure' => 'Registration failed!']);
			}
		} else {
			$validation_error = [
				'error' => [
					'username' => strip_tags(form_error('username')),
					'password' => strip_tags(form_error('password')),
					'completeName' => strip_tags(form_error('complete_name')),
					'birthInformation' => strip_tags(form_error('place_of_birth') . ' ' . form_error('date_of_birth')),
					'phoneNumber' => strip_tags(form_error('phone_number')),
					'email' => strip_tags(form_error('email')),
					'address' => strip_tags(form_error('address')),
				]
			];
			if ($account_type === 'doctor') {
				$validation_error['error']['doctorInformation'] = strip_tags(form_error('doctor_type') . ' ' . form_error('doctor_room'));
			}
			echo json_encode($validation_error);
		}
	}

	public function update()
	{
		$account_type = $this->input->post('account_type');
		$this->user_validation();
		if ($account_type === 'doctor') {
			$this->form_validation->set_rules('doctor_type', 'Doctor type', 'required');
			$this->form_validation->set_rules('doctor_room', 'Doctor room', 'required');
		}
		$username = $this->input->post('username');
		$data = [
			'username' => $username,
			'password' => $this->input->post('password'),
			'account_type' => $account_type,
			'complete_name' => $this->input->post('complete_name'),
			'place_of_birth' => $this->input->post('place_of_birth'),
			'date_of_birth' => $this->input->post('date_of_birth'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'account_created' => date('Y-m-d H:i:s')
		];
		if ($this->form_validation->run()) {
			if ($this->user_model->update_user($username, $data)) {
				if ($account_type === 'doctor') {
					$id_doctor = $this->input->post('doctor_id');
					$this->doctor_model->update_doctor($id_doctor, [
						'doctor_type' => $this->input->post('doctor_type'),
						'doctor_room' => $this->input->post('doctor_room')
					]);
				}
				$this->session->set_flashdata('success', 'Update account successful!');
				echo json_encode([
					'success' => 'Updated successfully!',
					'data' => [
						'username' => $username,
						'password' => $this->input->post('password')
					]
				]);
			} else {
				echo json_encode(['failure' => 'Update failed!']);
			}
		} else {
			$validation_error = [
				'error' => [
					'username' => strip_tags(form_error('username')),
					'password' => strip_tags(form_error('password')),
					'completeName' => strip_tags(form_error('complete_name')),
					'birthInformation' => strip_tags(form_error('place_of_birth') . ' ' . form_error('date_of_birth')),
					'phoneNumber' => strip_tags(form_error('phone_number')),
					'email' => strip_tags(form_error('email')),
					'address' => strip_tags(form_error('address')),
				]
			];
			if ($account_type === 'doctor') {
				$validation_error['error']['doctorInformation'] = strip_tags(form_error('doctor_type') . ' ' . form_error('doctor_room'));
			}
			echo json_encode($validation_error);
		}
	}

	public function delete()
	{
		echo json_encode(['success' => $this->user_model->delete_user($this->input->post('username'))]);
	}

	public function logout()
	{
		$this->session->unset_userdata('login');
		$this->session->set_flashdata('success', 'Successfully Logout!');
	}

	public function table($role = 'patient')
	{
		if ($role === 'patient') {
			$this->load->view('user/table', [
				'account_type' => 'patient'
			]);
		} elseif ($role === 'doctor') {
			$this->load->view('user/table', [
				'account_type' => 'doctor'
			]);
		} else {
			$this->load->view('user/table', [
				'account_type' => 'admin'
			]);
		}
	}

	public function dashboard()
	{
		if (!$this->session->userdata('login')) {
			$this->session->set_flashdata('failure', 'Please login to access dashboard');
			redirect();
		}
		$this->display('Dashboard', 'user/dashboard');
	}
}
