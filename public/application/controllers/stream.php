<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stream extends CI_Controller {
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
	public function get($type){
		$fbid=$this->session->userdata('id');
		$posts=filterPosts($fbid,$type);
		print_r($posts);
		die("POSTS");
		
	}
	
	public function words($words){
		  $fbid=$this->session->userdata('id');
		  $result=filterPostKeywords($fbid,$words);
		  print_r($result);
		  die("''''''''");
	}
}