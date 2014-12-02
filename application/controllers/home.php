<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
   
    private $CI_Session;
    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');   
        $this->load->model('user_model');   
        $this->CI_Session=new session_helper();
    }

    public function index() {
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

        $this->load->view('home',$data);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */