<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cuisine
 *
 * @author RashFlash
 */
class cuisine extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('cuisine_model');
    }
    public function getallcuisines(){
        $cuisines=$this->cuisine_model->getAllCuisines();
        
        echo json_encode($cuisines);
    }
    
    public function cuisinepage(){
        $this->load->view('cuisine');
    }
}
