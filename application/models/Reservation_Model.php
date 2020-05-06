<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('reservation');
	}

	public function generate_reservation_id()
	{
		return $this->generate_id('r');
	}

	public function read_by_reservation_id($reservation_id)
	{
		$select = 'reservation_id as `id`, user_patient.complete_name as `patient_name`, 
		user_doctor.complete_name as `doctor_name`, doctor_type, reservation_date, 
		reservation_caption, reservation_time, reservation_status';
		$this->db->select($select);
		$this->db->join('patient', 'patient.patient_id = reservation.patient_id');
		$this->db->join('doctor', 'doctor.doctor_id = reservation.doctor_id');
		$this->db->join('user as `user_doctor`', 'user_doctor.username = doctor.username');
		$this->db->join('user as `user_patient`', 'user_patient.username = patient.username');
		$this->db->where('reservation_id', $reservation_id);
		return $this->read_one();
	}

	public function read_by_patient_id($patient_id)
	{
		$select = 'reservation_id as `id`, user.complete_name as `name`, doctor_type, reservation_date, 
		reservation_caption, reservation_time, reservation_status';
		$this->db->select($select);
		$this->db->join('patient', 'patient.patient_id = reservation.patient_id');
		$this->db->join('doctor', 'doctor.doctor_id = reservation.doctor_id');
		$this->db->join('user', 'doctor.username = user.username');
		$this->db->where('patient.patient_id', $patient_id);
		return $this->read();
	}

	public function read_by_doctor_id($doctor_id)
	{
		$select = 'reservation_id as `id`, user.complete_name as `name`, reservation_date, 
		reservation_caption, reservation_time, reservation_status';
		$this->db->select($select);
		$this->db->join('doctor', 'doctor.doctor_id = reservation.doctor_id');
		$this->db->join('patient', 'patient.patient_id = reservation.patient_id');
		$this->db->join('user', 'patient.username = user.username');
		$this->db->where('doctor.doctor_id', $doctor_id);
		return $this->read();
	}

	public function update_reservation($reservation_id, $data)
	{
		$this->db->where('reservation_id', $reservation_id);
		return $this->update($data);
	}

	public function delete_reservation($reservation_id)
	{
		$this->db->where('reservation_id', $reservation_id);
		return $this->delete();
	}
}
