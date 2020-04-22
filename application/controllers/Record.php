<?php
class Record extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Record_model');
		$this->load->library('form_validation'); 
	
	}


	public function index()
	{
		
		$data['judul'] = 'Medical Record';
        $data['record'] = $this->Record_model->getAllRecord();
        
		$this->load->view('templates/header', $data);
		$this->load->view('record/index', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['judul'] = 'INPUT NEW MEDICAL RECORD'; 

		$this->form_validation->set_rules('medical_record_id','Medical_record_id','required');
		$this->form_validation->set_rules('reservation_id','Reservation_id','required');
        $this->form_validation->set_rules('disease_id','Disease_id','required');
        $this->form_validation->set_rules('medical_record_caption','Medical_record_caption','required');

		if($this->form_validation->run() == FALSE){
		$this->load->view('templates/header',$data);
		$this->load->view('record/tambah');
		$this->load->view('templates/footer');
		} else {
			$this->Record_model->tambahDataRecord();
			$this->session->set_flashdata('flash','Ditambahkan');
			redirect('record');
		}
		
	}

	public function hapus($id)
	{
		$this->Record_model->hapusDataRecord($id);
		$this->session->set_flashdata('flash','Dihapus');
		redirect('record');


	}

	public function ubah($id)
	{
		$data['judul'] = 'CHANGE MEDICAL RECORD';

		$data['record'] = $this->Record_model->getRecordById($id);
		
		
		$this->form_validation->set_rules('medical_record_id','Medical Record id','required');
		$this->form_validation->set_rules('reservation_id','Reservation_id','required');
        $this->form_validation->set_rules('disease_id','Disease','required');
        $this->form_validation->set_rules('medical_record_caption','Caption','required');

		if($this->form_validation->run() == FALSE){
		$this->load->view('templates/header',$data);
		$this->load->view('record/ubah',$data);
		$this->load->view('templates/footer');
		} else {
			$this->Record_model->ubahDataRecord();
			$this->session->set_flashdata('flash','Diubah ');
			redirect('record');
		}
		  

	}
}