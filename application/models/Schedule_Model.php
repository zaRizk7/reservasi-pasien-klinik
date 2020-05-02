<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_Model extends Base_Model
{
	public function __construct()
	{
		parent::__construct('schedule');
	}

	public function generate_schedule_id()
	{
		return $this->generate_id('s');
	}

	public function read_schedule()
	{
		$select = 'schedule_id, schedule.doctor_id, user.complete_name as `name`, doctor_type, doctor_room, day, start_time, finish_time';
		$this->db->select($select);
		$this->db->join('doctor', 'doctor.doctor_id = schedule.doctor_id');
		$this->db->join('user', 'user.username = doctor.username');
		return $this->read();
	}

	public function read_by_schedule_id($schedule_id)
	{
		$this->db->where('schedule_id', $schedule_id);
		return $this->read_one();
	}

	public function read_by_doctor_id($doctor_id)
	{
		$select = 'schedule_id, schedule.doctor_id, user.complete_name as `name`, doctor_type, doctor_room, day, start_time, finish_time';
		$this->db->select($select);
		$this->db->join('doctor', 'doctor.doctor_id = schedule.doctor_id');
		$this->db->join('user', 'user.username = doctor.username');
		$this->db->where('schedule.doctor_id', $doctor_id);
		return $this->read();
	}

	public function update_schedule($schedule_id, $data)
	{
		$this->db->where('schedule_id', $schedule_id);
		return $this->update($data);
	}

	public function delete_schedule($schedule_id)
	{
		$this->db->where('schedule_id', $schedule_id);
		return $this->delete();
	}
}
