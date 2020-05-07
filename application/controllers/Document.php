<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->helper('file');
		$this->load->model('document_model');
		$this->load->model('user_model');
	}

	public function fetch($document_name = null)
	{
		$this->auth();
		if ($document_name) {
			echo json_encode($this->document_model->read_by_name($document_name));
		} else {
			echo json_encode($this->document_model->read());
		}
	}

	public function upload_portrait()
	{
		$this->auth();
		$config = [
			'upload_path' => './uploads/portrait_photo/',
			'allowed_types' => 'png|jpg|jpeg',
			'file_name' => "portrait-{$this->session->userdata('login')['username']}",
			'overwrite' => true
		];

		$this->upload->initialize($config);
		if ($this->upload->do_upload('portrait_photo')) {
			$data = [
				'document_type' => 'portrait',
				'document_name' => $config['file_name'],
				'document_format' => $this->upload->data()['file_ext'],
				'document_size' => $this->upload->data()['file_size'],
				'username' => $this->session->userdata('login')['username']
			];
			$previous_data = $this->document_model->read_by_name($data['document_name']);
			if ($previous_data) {
				$this->document_model->update_document($previous_data['document_id'], $data);
				$this->session->set_flashdata('success', 'Portrait updated successfully!');
			} else {
				$data['document_id'] = $this->document_model->generate_document_id();
				$this->document_model->create($data);
				$this->session->set_flashdata('success', 'Portrait uploaded successfully!');
			}
			echo json_encode($this->upload->data());
		} else {
			echo json_encode($this->upload->display_errors());
		}
	}

	public function upload_identity_card()
	{
		$this->auth();
		$config = [
			'upload_path' => './uploads/identity_card/',
			'allowed_types' => 'pdf',
			'file_name' => "id-card-{$this->session->userdata('login')['username']}",
			'overwrite' => true
		];

		$this->upload->initialize($config);
		if ($this->upload->do_upload('identity_card')) {
			$data = [
				'document_type' => 'identity_card',
				'document_name' => $config['file_name'],
				'document_format' => $this->upload->data()['file_ext'],
				'document_size' => $this->upload->data()['file_size'],
				'username' => $this->session->userdata('login')['username']
			];
			$previous_data = $this->document_model->read_by_name($data['document_name']);
			if ($previous_data) {
				$this->document_model->update_document($previous_data['document_id'], $data);
				$this->session->set_flashdata('success', 'ID Card updated successfully!');
			} else {
				$data['document_id'] = $this->document_model->generate_document_id();
				$this->document_model->create($data);
				$this->session->set_flashdata('success', 'ID Card uploaded successfully!');
			}
			echo json_encode($this->upload->data());
		} else {
			echo json_encode($this->upload->display_errors());
		}
	}

	public function upload_health_insurance()
	{
		$this->auth();
		$config = [
			'upload_path' => './uploads/health_insurance/',
			'allowed_types' => 'pdf',
			'file_name' => "health-insurance-{$this->session->userdata('login')['username']}",
			'overwrite' => true
		];

		$this->upload->initialize($config);
		if ($this->upload->do_upload('health_insurance')) {
			$data = [
				'document_type' => 'health_insurance',
				'document_name' => $config['file_name'],
				'document_format' => $this->upload->data()['file_ext'],
				'document_size' => $this->upload->data()['file_size'],
				'username' => $this->session->userdata('login')['username']
			];
			$previous_data = $this->document_model->read_by_name($data['document_name']);
			if ($previous_data) {
				$this->document_model->update_document($previous_data['document_id'], $data);
				$this->session->set_flashdata('success', 'Health Insurance updated successfully!');
			} else {
				$data['document_id'] = $this->document_model->generate_document_id();
				$this->document_model->create($data);
				$this->session->set_flashdata('success', 'ID Card uploaded successfully!');
			}
			echo json_encode($this->upload->data());
		} else {
			echo json_encode($this->upload->display_errors());
		}
	}

	public function delete()
	{
		$this->auth();
		$document_name = $this->input->post('document_name');
		$document_type = $this->input->post('document_type');
		$result = $this->document_model->read_by_name($document_name);
		if ($result != null) {
			if ($document_type === 'portrait') {
				unlink("./uploads/portrait_photo/{$document_name}{$result['document_format']}");
			} elseif ($document_type === 'identity_card') {
				unlink("./uploads/identity_card/{$document_name}{$result['document_format']}");
			} else {
				unlink("./uploads/health_insurance/{$document_name}{$result['document_format']}");
			}
			$this->document_model->delete_document($document_name);
			$this->session->set_flashdata('success', 'Document successfully deleted!');
		}
	}

	public function table()
	{
		$this->auth();
		$this->load->view('document/table', [
			'docs' => $this->document_model->read()
		]);
	}

	public function admin_management()
	{
		$this->auth();
		$this->load->view('admin/document_management', [
			'user' => $this->user_model->read(),
			'document' => $this->document_model->read()
		]);
	}
}
