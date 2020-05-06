<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('admin');
	}

	public function generate_admin_id()
	{
		return $this->generate_id('a');
	}

	public function read_admin()
	{
		$select = 'admin_id as `id`, user.username, password, account_type, complete_name, 
		place_of_birth, date_of_birth, phone_number, email, address, account_created';
		$this->db->select($select);
		$this->db->join('user', 'user.username = admin.username');
		return $this->read();
	}

	public function read_by_username($username)
	{
		$select = 'admin_id as `id`, user.username, password, account_type, complete_name, 
		place_of_birth, date_of_birth, phone_number, email, address, account_created';
		$this->db->select($select);
		$this->db->join('user', 'user.username = admin.username');
		$this->db->where('user.username', $username);
		return $this->read_one();
	}

	public function update_admin($admin_id, $data)
	{
		$this->db->where('admin_id', $admin_id);
		return $this->update($data);
	}

	public function delete_admin($admin_id)
	{
		$this->db->where('admin_id', $admin_id);
		return $this->delete();
	}
}
