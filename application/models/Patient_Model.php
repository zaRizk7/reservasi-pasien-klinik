<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('patient');
	}

	public function generate_patient_id()
	{
		return $this->generate_id('p');
	}

	public function read_patient()
	{
		$select = 'patient_id as `id`, user.username, password, account_type, complete_name, 
		place_of_birth, date_of_birth, phone_number, email, address, account_created';
		$this->db->select($select);
		$this->db->join('user', 'user.username = patient.username');
		return $this->read();
	}

	public function read_by_username($username)
	{
		$select = 'patient_id as `id`, user.username, password, account_type, complete_name, 
		place_of_birth, date_of_birth, phone_number, email, address, account_created';
		$this->db->select($select);
		$this->db->join('user', 'user.username = patient.username');
		$this->db->where('user.username', $username);
		return $this->read_one();
	}

	public function update_patient($patient_id, $data)
	{
		$this->db->where('patient_id', $patient_id);
		return $this->update($data);
	}

	public function delete_patient($patient_id)
	{
		$this->db->where('patient_id', $patient_id);
		return $this->delete();
	}
}
