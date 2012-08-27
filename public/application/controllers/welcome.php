<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
       }
	public function index()
	{
		global $facebook;
		$params = array(
  		'scope' => 'read_stream, friends_likes',
  		'redirect_uri' => site_url('welcome/init')
		);
		$data=array();
		$data['login_url']=$facebook->getLoginUrl($params);
		$this->template->load('template', 'login', $data);
	}
	public function init(){
		global $facebook;
		$access_token = $facebook->getAccessToken();
		$user = $facebook->getUser();
		$user_data=$facebook->api('/'.$user,'GET');
		print_r($user_data);
		

	}
}
