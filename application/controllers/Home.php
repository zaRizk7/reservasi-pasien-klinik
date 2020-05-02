<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Base_Controller
{
	public function index()
	{
		$this->display('ServeHealth - The Clinic Reservation Service', 'home/index');
	}

	public function about()
	{
		$this->display('The teams behind ServeHealth!', 'home/about');
	}

	public function not_found()
	{
		$this->display('Page Not Found!', 'home/not_found');
	}
}
