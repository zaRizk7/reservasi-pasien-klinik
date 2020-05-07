<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('comment_model');
	}

	public function index($reservation_id)
	{
		$this->auth();
		$this->load->view('reservation/comment', ['id' => $reservation_id]);
	}

	public function load_comment($reservation_id)
	{
		$this->auth();
		$this->load->view('reservation/comment', ['id' => $reservation_id]);
	}

	public function fetch($reservation_id = null)
	{
		$this->auth();
		if ($reservation_id === null) {
			echo json_encode($this->comment_model->read());
		} else {
			echo json_encode($this->comment_model->read_by_reservation_id($reservation_id));
		}
	}

	public function create()
	{
		$this->auth();
		$this->form_validation->set_rules('comment_caption', 'Caption', 'required');

		$data = [
			'comment_id' => $this->comment_model->generate_comment_id(),
			'comment_caption' => $this->input->post('comment_caption'),
			'comment_date' => date('y:m:d h:i:s'),
			'reservation_id' => $this->input->post('reservation_id'),
			'username' => $this->session->userdata('login')['username']
		];

		if ($this->form_validation->run()) {
			$this->comment_model->create($data);
			echo json_encode([
				'success' => 'success'
			]);
		} else {
			echo json_encode([
				'error' => [
					'comment_caption' => strip_tags(form_error('comment_caption'))
				]
			]);
		}
	}

	public function delete()
	{
		$this->auth();
		if ($this->comment_model->delete_comment($this->input->post('comment_id'))) {
			echo json_encode(['success' => 'Comment deleted!']);
		}
	}
}
