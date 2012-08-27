<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
		global $facebook;
		$access_token = $facebook->getAccessToken();
		$user = $facebook->getUser();
		
		$user_data=$facebook->api('/'.$user,'GET');
		
		$this->load->view('test/fb.php');
	}
}