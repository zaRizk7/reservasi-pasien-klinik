<?php
class Schedule extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Schedule_model');
        $this->load->library('form_validation');        
    }
    
    public function read($id) 
    {
        $row = $this->Tbl_jadwal_praktek_dokter_model->get_by_id($id);
        if ($row) {
            $data = array(
		'schedule_id' => $row->schedule_id,
		'username' => $row->username,
		'day' => $row->day,
		'begin_time' => $row->begin_time,
		'finish_time' => $row->finish_time,
	    );
            $this->template->load('template','schedule/v_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('schedule'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('schedule/create_action'),
	        'schedule_id' => set_value('schedule_id'),
	        'username' => set_value('username'),
	        'day' => set_value('day'),
	        'begin_time' => set_value('begin_time'),
	        'finish_time' => set_value('finish_timme'),
	);
        $this->template->load('template','schedule/v_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'day' => $this->input->post('day',TRUE),
		'begin_time' => $this->input->post('begin_time',TRUE),
		'finish_time' => $this->input->post('finish_time',TRUE),
	    );

            $this->schedule_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('schedule'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_jadwal_praktek_dokter_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jadwalpraktek/update_action'),
                'schedule_id' => set_value('schedule_id'),
                'username' => set_value('username'),
                'day' => set_value('day'),
                'begin_time' => set_value('begin_time'),
                'finish_time' => set_value('finish_timme'),
	    );
            $this->template->load('template','schedule/v_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('schedule'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('schedule_id', TRUE));
        } else {
            $data = array(
		'username' =>$this->input->post('kode_dokter',TRUE),
		'day' => $this->input->post('day',TRUE),
		'begin_time' => $this->input->post('begin_time',TRUE),
		'finish_time' => $this->input->post('finish_time',TRUE),
	    );

            $this->schedule_model->update($this->input->post('schedu;e_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('schedule'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->schedule_model->get_by_id($id);

        if ($row) {
            $this->schedule_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('schedule'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('schedule'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('day', 'day', 'trim|required');
	$this->form_validation->set_rules('begin_time', 'begin time', 'trim|required');
	$this->form_validation->set_rules('finish_time', 'finish_time', 'trim|required');

	$this->form_validation->set_rules('schedule_id', 'schedule_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
  