<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_Model extends CI_Model
{
	private $table_name;

	public function __construct($table_name)
	{
		parent::__construct();
		$this->table_name = $table_name;
	}

	public function generate_id($id)
	{
		$count = $this->count();
		if ($count < 10) {
			$id .= '000';
		} elseif ($count < 100) {
			$id .= '00';
		} elseif ($count < 1000) {
			$id .= '0';
		}
		return $id . ($count + 1);
	}

	public function create($data)
	{
		$this->db->insert($this->table_name, $data);
		return $this->db->affected_rows() > 0;
	}

	public function read()
	{
		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

	public function read_one()
	{
		$query = $this->db->get($this->table_name);
		return $query->row_array();
	}

	public function update($data)
	{
		$this->db->update($this->table_name, $data);
		return $this->db->affected_rows() > 0;
	}

	public function delete()
	{
		$this->db->delete($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	public function count()
	{
		$query = $this->db->count_all_results($this->table_name);
		return $query;
	}
}
