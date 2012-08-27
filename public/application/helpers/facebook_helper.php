<?php
define('DB','db/');
//Helpers

function saveUserPost($idPost){
    
}

function deleteUserPost($idPost){
    
}

function listUserPost($fbid){
    
}

// $media_type = photo

function filterPostKeywords($fbid,$words){
    global $facebook;
    $access_token = $facebook->getAccessToken();
    //$fbid=$this->session->userdata('id');

		$sql="SELECT post_id, viewer_id, app_id, source_id, created_time, attribution, actor_id, message, app_data, action_links, attachment, comments, likes, privacy, type, permalink, xid
      	FROM stream WHERE source_id = ".$fbid." limit 100";

		$data = $facebook->api(array('method' => 'fql.query','query' => $sql));
		
		$result=null;
		
        $array_words=explode("+",strtolower($words));
        foreach($data as $post){
                 $text=$post['message'].$post['message'];
                 if(key_exists('attachment',$post)){
                          if(key_exists('name',$post['attachment']))
                                   $text.="|".$post['attachment']['name'];
                          if(key_exists('caption',$post['attachment']))
                                   $text.="|".$post['attachment']['caption'];
                          if(key_exists('description',$post['attachment']))
                                   $text.="|".$post['attachment']['description'];
                          $text=strtolower($text);
                 }
                 
                                                  
                 $count=0;
                 foreach($array_words as $word){
                          if(strpos($text,$word))
                                   $count++;
                 }
                 if(count($array_words)==$count)
                          $result[]=$post;
        }
        
    return $result;
}


function filterPosts($fbid,$media_type){
    $result=null;
    
    global $facebook;
    $access_token = $facebook->getAccessToken();
    //$fbid=$this->session->userdata('id');

    $sql="SELECT post_id, viewer_id, app_id, source_id, created_time, attribution, actor_id, message, app_data, action_links, attachment, comments, likes, privacy, type, permalink, xid
FROM stream WHERE source_id = ".$fbid." limit 100";

    $data = $facebook->api(array('method' => 'fql.query','query' => $sql));
    
    $result=null;
    
      foreach($data as $post){
          if(key_exists('attachment',$post) && key_exists('media',$post['attachment'])){
              foreach($post['attachment']['media'] as $media){
                  if($media['type']==$media_type)
                      $result[]=$post;
              }
          }
      }
    
    return $result;
}

function saveListPost($array_data,$fbid){
    if(is_array($array_data) && count($array_data)){
        if(!file_exists(DB.$fbid))
            mkdir(DB.$fbid);
        file_put_contents(DB.$fbid."/list",serialize($array_data));
    }
}

function getListPosts($fbId){
    $array=null;
    if(file_exists(DB.$fbId."/list")){
        $data=file_get_contents(DB.$fbId."/list");
        $array=unserialize($data);
    }
    return $array;
}

function saveUserData($array_data){
    if(is_array($array_data) && count($array_data)){
        if(!file_exists(DB.$array_data['id']))
            mkdir(DB.$array_data['id']);
        file_put_contents(DB.$array_data['id']."/user",serialize($array_data));
    }
}

function getUserData($fbId){
    $array=null;
    if(file_exists(DB.$fbId."/user")){
        $data=file_get_contents(DB.$fbId."/user");
        $array=unserialize($data);
    }
    return $array;
}