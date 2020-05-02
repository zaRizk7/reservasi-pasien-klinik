<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('doctor');
	}

	public function generate_doctor_id()
	{
		return $this->generate_id('d');
	}

	public function read_doctor()
	{
		$select = 'doctor_id as `id`, user.username, password, doctor_type, doctor_room, account_type, complete_name, place_of_birth, date_of_birth, phone_number, email, address, account_created';
		$this->db->select($select);
		$this->db->join('user', 'user.username = doctor.username');
		return $this->read();
	}

	public function read_by_username($username)
	{
		$select = 'doctor_id as `id`, user.username, password, doctor_type, doctor_room, account_type, complete_name, place_of_birth, date_of_birth, phone_number, email, address, account_created';
		$this->db->select($select);
		$this->db->join('user', 'user.username = doctor.username');
		$this->db->where('user.username', $username);
		return $this->read_one();
	}

	public function update_doctor($doctor_id, $data)
	{
		$this->db->where('doctor_id', $doctor_id);
		return $this->update($data);
	}

	public function delete_doctor($doctor_id)
	{
		$this->db->where('doctor_id', $doctor_id);
		return $this->delete();
	}
}
