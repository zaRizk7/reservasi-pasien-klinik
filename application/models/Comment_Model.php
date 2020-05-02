<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('comment');
	}

	public function generate_comment_id()
	{
		return $this->generate_id('c');
	}

	public function read_by_comment_id($comment_id)
	{
		$this->db->where('comment_id', $comment_id);
		return $this->read();
	}

	public function update_comment($comment_id, $data)
	{
		$this->db->where('comment_id', $comment_id);
		return $this->update($data);
	}

	public function delete_comment($comment_id)
	{
		$this->db->where('comment_id', $comment_id);
		return $this->delete();
	}
}
