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
		return $this->read_one();
	}

	public function read_by_reservation_id($reservation_id)
	{
		$select = 'comment_id, comment_caption, comment_date, user.complete_name as `name`, reservation_id';
		$this->db->select($select);
		$this->db->join('user', 'user.username = comment.username');
		$this->db->where('reservation_id', $reservation_id);
		$this->db->order_by('comment_date', 'DESC');
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
