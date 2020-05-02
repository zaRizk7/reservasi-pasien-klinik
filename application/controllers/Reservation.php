<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('reservation_model');
		$this->load->model('doctor_model');
		$this->load->model('patient_model');
		$this->load->model('schedule_model');
	}

	public function admin_management()
	{
		$this->load->view('admin/schedule_management');
	}

	public function create()
	{
		$this->form_validation->set_rules('doctor_id', 'Doctor ID', 'required');
		$this->form_validation->set_rules('reservation_day', 'Day', 'required');
		$this->form_validation->set_rules('reservation_time', 'Reservation time', 'required');
		$this->form_validation->set_rules('reservation_caption', 'Caption', 'required');
		$data = [
			'reservation_id' => $this->reservation_model->generate_reservation_id(),
			'doctor_id' => $this->input->post('doctor_id'),
			'reservation_date' => $this->input->post('reservation_day'),
			'reservation_time' => $this->input->post('reservation_time'),
			'reservation_caption' => $this->input->post('reservation_caption'),
			'reservation_status' => 'reserved',
			'patient_id' => $this->patient_model->read_by_username($this->session->userdata('login')['username'])['id']
		];

		if ($this->form_validation->run()) {
			if (!$this->is_available(
				$this->input->post('reservation_day'),
				$this->input->post('reservation_time')
			)) {
				echo json_encode([
					'error' => [
						'reservationTime' => 'Time isn\'t available for this doctor.'
					], 'data' => $data
				]);
				exit();
			}
			$data['reservation_date'] = Date('y:m:d', strtotime('next ' . $this->schedule_model->read_by_schedule_id($this->input->post('reservation_day'))['day']));
			$this->reservation_model->create($data);
			echo json_encode([
				'message' => 'Reservation created successfully',
				'doctor'
			]);
		} else {
			echo json_encode([
				'error' => [
					'doctorId' => strip_tags(form_error('doctor_id')),
					'reservationDay' =>  strip_tags(form_error('reservation_day')),
					'reservationTime' => strip_tags(form_error('reservation_time')),
					'reservationCaption' => strip_tags(form_error('reservation_caption'))
				],
				'data' => $data
			]);
		}
	}

	public function fetch()
	{
		if ($this->session->userdata('login')['account_type'] === 'patient') {
			$id = $this->patient_model->read_by_username($this->session->userdata('login')['username'])['id'];
			echo json_encode($this->reservation_model->read_by_patient_id($id));
		} else {
			$id = $this->doctor_model->read_by_username($this->session->userdata('login')['username'])['id'];
			echo json_encode($this->reservation_model->read_by_doctor_id($id));
		}
	}

	private function is_available($schedule_id, $time)
	{
		$result = $this->schedule_model->read_by_schedule_id($schedule_id);
		return strtotime($time) >= strtotime($result['start_time'])
			&& strtotime($time) <= strtotime($result['finish_time']);
	}

	public function table()
	{
		$this->load->view('reservation/table');
	}
}
