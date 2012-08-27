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
		$this->template->load('template', 'init', $data);
		$this->session->set_userdata('fb',$data['user_data']);
		$this->session->set_userdata('id',$data['user_data']['id']);
		saveUserData($data['user_data']);
	}
	public function imagenes(){
		global $facebook;
		$user = $facebook->getUser();
		$data['imagenes']=filterPosts($user, 'photo');
		$this->load->view('imagenes',$data);
	}
	public function videos(){
		global $facebook;
		$user = $facebook->getUser();
		$data['videos']=filterPosts($user, 'video');
		//print_r($data['videos']);
		$this->load->view('videos',$data);
	}
	public function links(){
		global $facebook;
		$user = $facebook->getUser();
		$data['links']=filterPosts($user, 'link');
		//print_r($data['links']);
		$this->load->view('links',$data);
	}
}
