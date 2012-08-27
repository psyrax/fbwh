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
		global $facebook;
		$access_token = $facebook->getAccessToken();
		$fbid=$this->session->userdata('id');

		$sql="SELECT post_id, viewer_id, app_id, source_id, created_time, attribution, actor_id, message, app_data, action_links, attachment, comments, likes, privacy, type, permalink, xid
      	FROM stream WHERE source_id = ".$fbid." limit 100";

		$data = $facebook->api(array('method' => 'fql.query','query' => $sql));
		
		$result=null;
		
		  foreach($data as $post){
		      if(key_exists('attachment',$post) && key_exists('media',$post['attachment'])){
			  foreach($post['attachment']['media'] as $media){
			      if($media['type']==$type)
				  $result[]=$post;
			  }
		      }
		  }
		  
		  die(json_encode($result));
	}
	
	public function words($words){
		  $fbid=$this->session->userdata('id');
		  $result=filterPostKeywords($fbid,$words);
		  print_r($result);
		  die("''''''''");
	}
}