<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
		global $facebook;
		print_r($facebook);
		die("---");
		$this->load->view('test/fb.php');
	}
}