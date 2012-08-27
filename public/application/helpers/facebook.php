<?php
define('DB','db/');
//Helpers

function getUserData($username){
    
}

function getLikes(){
    
}

function getShareds(){
    
}

function savePost(){
    
}

function sharePost(){
    
}

function setCategoryToPost($post,$category){
    
}

function listCategories(){
    
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