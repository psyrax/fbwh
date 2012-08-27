<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Controller {
	public function index()
	{
		global $facebook;
		$access_token = $facebook->getAccessToken();

		$user = $facebook->getUser();
		$data=listAppFriends($user);
		print_r($data);
		die("---");
	}
}