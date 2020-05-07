<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('user');
	}

	public function read_by_username($username)
	{
		$this->db->where('username', $username);
		return $this->read_one();
	}

	public function update_user($username, $data)
	{
		$this->db->where('username', $username);
		return $this->update($data);
	}

	public function delete_user($username)
	{
		$this->db->where('username', $username);
		return $this->delete();
	}
}
