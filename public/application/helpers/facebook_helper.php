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
function filterPosts($fbid,$media_type){
    $result=null;
    $posts=getListPosts($fbid);
    foreach($posts as $post){
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