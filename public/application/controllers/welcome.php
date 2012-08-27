<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		global $facebook;
		$data=array();
		$data['login_url']=$facebook->getLoginUrl();
		print_r($data);
		$this->template->load('template', 'login', $data);
	}
}
