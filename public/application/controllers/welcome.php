<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	 public function __construct()
       {
            parent::__construct();
       }
       
       public function logout(){
		global $facebook;
		$access_token = $facebook->getAccessToken();
		
		$params = array( 'next' => site_url('welcome') );
		$facebook->getLogoutUrl($params);

		$this->session->sess_destroy();
		header("Location:./");
       }
       
	public function index()
	{
		global $facebook;
		$fbid=$this->session->userdata('id');
		if($fbid){
			header("Location:init");
			exit(0);
		}
		
		$params = array(
  		'scope' => 'read_stream, friends_likes, user_likes,user_photos,user_status,read_stream, publish_stream',
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
		$data['user_data']=$facebook->api('/'.$user,'GET');
		$this->session->set_userdata('fb',$data['user_data']);
		saveUserData($data['user_data']);
		$this->template->load('template', 'init', $data);
		$this->session->set_userdata('fb',$data['user_data']);
		$this->session->set_userdata('id',$data['user_data']['id']);
		
		saveUserData($data['user_data']);
	}
	
	public function imagenes(){
		$this->load->view('imagenes');
	}
	
	public function videos(){
		$this->load->view('videos');
	}
}
