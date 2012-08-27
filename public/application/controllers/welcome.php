<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		global $facebook;
		$data=array();
		$this->template->load('template', 'login', $data);
	}
}
