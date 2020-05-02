<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('document_model');
		$this->load->model('user_model');
	}

	public function table()
	{
		$this->load->view('document/table', [
			'docs' => $this->document_model->read()
		]);
	}

	public function admin_management()
	{
		$this->load->view('admin/document_management', [
			'user' => $this->user_model->read(),
			'document' => $this->document_model->read()
		]);
	}
}
