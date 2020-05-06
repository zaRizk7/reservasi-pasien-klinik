<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('document');
	}

	public function generate_document_id()
	{
		return $this->generate_id('f');
	}

	public function read_by_username($username)
	{
		$this->db->where('username', $username);
		return $this->read();
	}

	public function read_by_name($document_name)
	{
		$this->db->where('document_name', $document_name);
		return $this->read_one();
	}

	public function update_document($document_id, $data)
	{
		$this->db->where('document_id', $document_id);
		return $this->update($data);
	}

	public function delete_document($document_name)
	{
		$this->db->where('document_name', $document_name);
		return $this->delete();
	}
}
