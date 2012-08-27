<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
		global $facebook;
		$this->load->view('test/fb.php');
	}
}