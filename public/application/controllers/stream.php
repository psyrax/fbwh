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
	public function get(){
		global $facebook;
		$access_token = $facebook->getAccessToken();

		$user = $facebook->getUser();
		$user_data=$facebook->api('/'.$user,'GET');

		$sql="SELECT post_id, viewer_id, app_id, source_id, updated_time, created_time, filter_key, attribution, actor_id, target_id, message, app_data, action_links, attachment, comments, likes, privacy, type, permalink, xid
      	FROM stream WHERE source_id = ".$user_data['id']." limit 20";

		$data = $facebook->api(array('method' => 'fql.query','query' => $sql));
		
		echo "<pre>"; print_r($data); echo "</pre>"; 

	}
}