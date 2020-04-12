<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function get_user_login($username = null, $password = null)
	{
		return $this->db->get_where('user', [
			'username' => $username,
			'password' => $password
		])->row_array();
	}
}
