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
		header("Location:".site_url('welcome'));
       }
       
	public function index()
	{
		global $facebook;
		$fbid=$this->session->userdata('id');
		if($fbid){
			header("Location:".site_url('welcome/init'));
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
		$data['friends']=listAppFriends($user);
		
		//$this->session->set_userdata('fb',$data['user_data']);
		$this->template->load('template', 'init', $data);
		//$this->session->set_userdata('fb',$data['user_data']);
		//$this->session->set_userdata('id',$data['user_data']['id']);
		
		saveUserData($data['user_data']);
	}
	
	public function imagenes(){
		global $facebook;
		$user = $facebook->getUser();
		$data['user']=$user;
		$data['imagenes']=filterPosts($user, 'photo');
		$this->load->view('imagenes',$data);
	}
	
	public function videos(){
		global $facebook;
		$user = $facebook->getUser();
		$data['user']=$user;
		$data['videos']=filterPosts($user, 'video');
		//print_r($data['videos']);
		$this->load->view('videos',$data);
	}
	public function links(){
		global $facebook;
		$user = $facebook->getUser();
		$data['user']=$user;
		$data['links']=filterPosts($user, 'link');
		//print_r($data['links']);
		$this->load->view('links',$data);
	}
	
	public function favoritos(){
		global $facebook;
		$user = $facebook->getUser();
		$data['user']=$user;
		$posts=listUserPost($user);
		$data['posts']=$posts;
		$this->load->view('favoritos',$data);
	}
	public function faver($id){
		global $facebook;
		$user = $facebook->getUser();
		$data['user']=$user;
		$posts=listUserPost($user);
	}
	
	public function amigo($idAmigo){
		global $facebook;
		$user = $facebook->getUser();
		$data['user']=$user;
		$posts=listUserPost($idAmigo);
		$posts=listUserPost($user);
		$data['posts']=$posts;
		$this->load->view('amigo',$data);
	}
	public function buscador($query){
		global $facebook;
		$user = $facebook->getUser();
		$data['user']=$user;
		$data['imagenes']=filterPostKeywords($user,$query);
		$this->load->view('buscador',$data);
		//print_r($result);
		//die("''''''''");
	}
}
