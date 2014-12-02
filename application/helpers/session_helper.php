<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RF_Session
 *
 * @author RashFlash
 */
class session_helper {
    private $CI;
    public function __construct() {
        $this->CI=&get_instance();
    }
    
    public function get_session($key){
        if(!$key){
            return $this->CI->session->all_userdata();
        }
        
        if(isset($this->CI->session)){
            return $this->CI->session->userdata($key);
        }
        
        return false;
    }
    
    public function set_session($key,$value){
        $this->CI->session->set_userdata($key,$value);
    }
    
    public function clear_session(){
        $this->CI->session->sess_destroy();
    }
}
