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
      private $CI_Session;
    public function __construct() {
        parent::__construct();
         $this->load->model('home_model');   
        $this->load->model('user_model');   
        $this->load->model('cuisine_model');
          $this->load->model('question_answer_model');  
            $this->load->model('facebook_model');   
        $this->CI_Session=new session_helper();
    }
    public function getallcuisines(){
        $cuisines=$this->cuisine_model->getAllCuisines();
        
        echo json_encode($cuisines);
    }
    
    public function view($cuisine){
        $status = $this->CI_Session->get_session('status');
          if (!$status) {                       
            $data['loggedIn']=false;
             $data['country_choosen']=false;
        } 
        else {
            if ($status === 'true') {                
                $data['loggedIn']=true;
                $user_id=$this->CI_Session->get_session('uid');
                $user_detail=$this->home_model->getUserById($user_id);
                $user_detail=$user_detail->result_array;
                $data['picture']=$user_detail[0]['picture'];                 
                $data['name']=$user_detail[0]['first_name']." ".$user_detail[0]['last_name'];
               $country=$user_detail[0]['country'];
               if(strlen($country)>2)
                   $data['country_choosen']=$country;
               else
                   $data['country_choosen']=false;
               
               $this->user_model->calucalte_updateUserRank($user_id);
                 
               $user_stats=$this->user_model->getUser_StatsById($user_id);
               $data['total_points']=$user_stats->points;
               $data['global_rank']=$user_stats->global_rank;
                
            } else if ($status === 'false') {
                 $data['loggedIn']=false;
                  $data['country_choosen']=false;
            }
        }
        
        //$cuisine_url=$cuisine;
        $cuisine=$this->question_answer_model->getTitleFromUrl($cuisine);
        
        $cuisine_detail=$this->cuisine_model->getCuisineDetailByName($cuisine);
        $recipies=$this->cuisine_model->getAllRecipiesinCuisine($cuisine_detail->cuisine_id);
         $data['cuisine']=$cuisine_detail;
         $data['recipies']=$recipies;        
        $this->load->view('cuisine',$data);
    }
}
