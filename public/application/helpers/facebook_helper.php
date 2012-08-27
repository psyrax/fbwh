<?php
define('DB','db/');
//Helpers

function saveUserPost($idPost,$idUser=null){
    
}

function deleteUserPost($idPost){
    
}

function listUserPost($fbid=null){
    
}

function saveListPost($array_data){
    if(is_array($array_data) && count($array_data)){
        if(!file_exists(DB.$array_data['id']))
            mkdir(DB.$array_data['id']);
        file_put_contents(DB.$array_data['id']."/list",serialize($array_data));
    }
}

function getListPosts($fbId=null){
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

function getUserData($fbId=null){
    $array=null;
    if(file_exists(DB.$fbId."/user")){
        $data=file_get_contents(DB.$fbId."/user");
        $array=unserialize($data);
    }
    return $array;
}


function getFBID(){
    
}