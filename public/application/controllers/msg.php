<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msg extends CI_Controller {
	public function index()
	{
		global $facebook;
		$access_token = $facebook->getAccessToken();

		$user = $facebook->getUser();
		$user_data=$facebook->api('/'.$user,'GET');

		$sql="SELECT post_id, viewer_id, app_id, source_id, updated_time, created_time, filter_key, attribution, actor_id, target_id, message, app_data, action_links, attachment, comments, likes, privacy, type, permalink, xid
      	FROM stream WHERE source_id = ".$user_data['id']." limit 20";

		$data = $facebook->api(array('method' => 'fql.query','query' => $sql));
		
		//echo "<pre>"; print_r($data); echo "</pre>";
		
		$fbid=$this->session->userdata('id');
		$ddd=filterPosts($fbid,"photo");
		echo "<pre>"; print_r($ddd); echo "</pre>";
	}
}