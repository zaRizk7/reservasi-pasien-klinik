<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('schedule_model');
		$this->load->model('doctor_model');
	}

	public function admin_management()
	{
		$this->load->view('admin/schedule_management', [
			'doctor_data' => $this->doctor_model->read_doctor(),
			'schedule' => $this->schedule_model->read()
		]);
	}

	public function table()
	{
		$this->load->view('schedule/table', [
			'doctor_id' => $this->session->userdata('login')['account_type'] !== 'doctor' ? null
				: $this->session->userdata('login')['doctor_id']
		]);
	}

	public function fetch($doctor_id = null)
	{
		if ($this->session->userdata('login') && $doctor_id != null) {
			echo json_encode($this->schedule_model->read_by_doctor_id($doctor_id));
			exit();
		} elseif ($this->session->userdata('login') && $this->session->userdata('login')['account_type'] === 'admin') {
			echo json_encode($this->schedule_model->read_schedule());
		} elseif (!$this->session->userdata('login')) {
			$this->session->set_flashdata('failure', 'Only admin allowed!');
			redirect();
		} else {
			echo json_encode([]);
		}
	}

	public function fetch_one($schedule_id = null)
	{
		$this->auth_admin();
		echo json_encode($this->schedule_model->read_by_schedule_id($schedule_id));
	}

	public function create()
	{
		$this->form_validation->set_rules('doctor_id', 'Doctor ID', 'required');
		$this->form_validation->set_rules('day', 'Day', 'required');
		$this->form_validation->set_rules('start_time', 'Start time', 'required');
		$this->form_validation->set_rules('finish_time', 'Finish time', 'required');
		$data = [
			'schedule_id' => $this->schedule_model->generate_schedule_id(),
			'doctor_id' => $this->input->post('doctor_id'),
			'day' => $this->input->post('day'),
			'start_time' => $this->input->post('start_time'),
			'finish_time' => $this->input->post('finish_time')
		];

		if ($this->form_validation->run()) {
			$this->schedule_model->create($data);
			echo json_encode(['message' => 'Schedule created successfully']);
		} else {
			echo json_encode([
				'error' => [
					'doctorId' => strip_tags(form_error('doctor_id')),
					'day' =>  strip_tags(form_error('day')),
					'startTime' => strip_tags(form_error('start_time')),
					'finishTime' => strip_tags(form_error('finish_time'))
				],
				'data' => $data
			]);
		}
	}


	public function update()
	{
		$this->form_validation->set_rules('day', 'Day', 'required');
		$this->form_validation->set_rules('start_time', 'Start time', 'required');
		$this->form_validation->set_rules('finish_time', 'Finish time', 'required');
		$data = [
			'schedule_id' => $this->input->post('schedule_id'),
			'doctor_id' => $this->input->post('doctor_id'),
			'day' => $this->input->post('day'),
			'start_time' => $this->input->post('start_time'),
			'finish_time' => $this->input->post('finish_time')
		];

		if ($this->form_validation->run()) {
			$this->schedule_model->update_schedule($this->input->post('schedule_id'), $data);
			echo json_encode(['message' => 'Schedule updated successfully']);
		} else {
			echo json_encode([
				'error' => [
					'day' =>  strip_tags(form_error('day')),
					'startTime' => strip_tags(form_error('start_time')),
					'finishTime' => strip_tags(form_error('finish_time'))
				],
				'data' => $data
			]);
		}
	}

	public function delete()
	{
		echo json_encode(['success' => $this->schedule_model->delete_schedule($this->input->post('schedule_id'))]);
	}
}
