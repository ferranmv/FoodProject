<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database_helper
 *
 * @author RashFlash
 */
class database_helper {
    private $CI;
    public function __construct() {
        $this->CI=&get_instance();
    }
    
    public function select($query){
        $result=$this->CI->db->query($query);
        return $result;
    }
    
}
