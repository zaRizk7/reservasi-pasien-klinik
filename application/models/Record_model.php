<?php

class Record_model extends CI_model
{

	public function getAllRecord()
	{
		 
		 return  $this->db->get('medical_record')->result_array();


	}

	public function tambahDataRecord()
	{
		$data = [
			"medical_record_id" => $this->input->post('medical_record_id', true),
			"reservation_id" => $this->input->post('reservation_id', true),
			"disease_id" => $this->input->post('disease_id', true),
			"medical_record_caption" => $this->input->post('medical_record_caption', true),
		];

	
		$this->db->insert('medical_record',$data);
	}

	public function hapusDataRecord($id)
	{
		
		$this->db->where('id',$id); 
		$this->db->delete('record');

	}

	public function getRecordById($id)
	{
		
		return $this->db->get_where('medical_record',['id'=>$id])->row_array();

	}

	public function ubahDataMahasiswa()
	{
		$data = [
			"medical_record_id" => $this->input->post('medical_record_id', true),
			"reservation_id" => $this->input->post('reservation_id', true),
			"disease_id" => $this->input->post('disease_id', true),
			"medical_record_caption" => $this->input->post('medical_record_caption', true),
		];

		
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('medical_record',$data); 
	}

	public function cariDataMahasiswa()
	{
		$keyword = $this->input->post('keyword', true);
		//use query builder class to search data mahasiswa based on keyword "nama" or "jurusan" or "nim" or "email"
		$this->db->like('medical_record_id',$keyword);
		$this->db->or_like('reservation_id',$keyword);
		$this->db->or_like('disease_id',$keyword);
		$this->db->or_like('email',$keyword);

		//return data mahasiswa that has been searched
		return $this->db->get('mahasiswa')->result_array();
	}
}