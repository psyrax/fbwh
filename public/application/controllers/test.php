<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
		global $facebook;
		echo Facebook::getLoginUrl();
		$this->load->view('test/fb.php');
	}
}