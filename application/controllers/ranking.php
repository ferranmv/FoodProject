<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ranking
 *
 * @author RashFlash
 */
class ranking extends CI_Controller {

    private $CI_Session;

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('user_model');
        $this->load->model('cuisine_model');
        $this->CI_Session = new session_helper();
    }

    public function globalranking() {
        $status = $this->CI_Session->get_session('status');
        if (!$status) {
            $data['loggedIn'] = false;
            $data['country_choosen'] = false;
        } else {
            if ($status === 'true') {
                $data['loggedIn'] = true;
                $user_id = $this->CI_Session->get_session('uid');
                $user_detail = $this->home_model->getUserById($user_id);
                $user_detail = $user_detail->result_array;
                $data['picture'] = $user_detail[0]['picture'];
                $data['name'] = $user_detail[0]['first_name'] . " " . $user_detail[0]['last_name'];
                $country = $user_detail[0]['country'];
                if (strlen($country) > 2)
                    $data['country_choosen'] = $country;
                else
                    $data['country_choosen'] = false;

                $this->user_model->calucalte_updateUserRank($user_id);

                $user_stats = $this->user_model->getUser_StatsById($user_id);
                $data['total_points'] = $user_stats->points;
                $data['global_rank'] = $user_stats->global_rank;
                $data['u_id']=$user_id;
            } else if ($status === 'false') {
                $data['loggedIn'] = false;
                $data['country_choosen'] = false;
            }
        }

        $data['ranking_type'] = 'Global Ranking';
        $data['current_date'] = date('d F Y');
        $data['ranking_data']=$this->getranking(0, 20);
        $data['total_pages']=$this->user_model->getTotalPages();
        

        $this->load->view('ranking', $data);
    }
    
     public function countryranking() {
        $status = $this->CI_Session->get_session('status');
        if (!$status) {
            $data['loggedIn'] = false;
            $data['country_choosen'] = false;
        } else {
            if ($status === 'true') {
                $data['loggedIn'] = true;
                $user_id = $this->CI_Session->get_session('uid');
                $user_detail = $this->home_model->getUserById($user_id);
                $user_detail = $user_detail->result_array;
                $data['picture'] = $user_detail[0]['picture'];
                $data['name'] = $user_detail[0]['first_name'] . " " . $user_detail[0]['last_name'];
                $country = $user_detail[0]['country'];
                if (strlen($country) > 2)
                    $data['country_choosen'] = $country;
                else
                    $data['country_choosen'] = false;

                $this->user_model->calucalte_updateUserRank($user_id);

                $user_stats = $this->user_model->getUser_StatsById($user_id);
                $data['total_points'] = $user_stats->points;
                $data['global_rank'] = $user_stats->global_rank;
                $data['u_id']=$user_id;
            } else if ($status === 'false') {
                $data['loggedIn'] = false;
                $data['country_choosen'] = false;
            }
        }
        
        $country=$_GET['c'];

        $data['ranking_type'] = $country.' Ranking';
        $data['current_date'] = date('d F Y');
        $data['ranking_data']=$this->getranking(0, 20,'country',$country);
        $data['ranking_country_name']=$country;
        $data['total_pages']=$this->user_model->getTotalPages($country);
        

        $this->load->view('ranking', $data);
    }
    
     public function cuisineranking() {
        $status = $this->CI_Session->get_session('status');
        if (!$status) {
            $data['loggedIn'] = false;
            $data['country_choosen'] = false;
        } else {
            if ($status === 'true') {
                $data['loggedIn'] = true;
                $user_id = $this->CI_Session->get_session('uid');
                $user_detail = $this->home_model->getUserById($user_id);
                $user_detail = $user_detail->result_array;
                $data['picture'] = $user_detail[0]['picture'];
                $data['name'] = $user_detail[0]['first_name'] . " " . $user_detail[0]['last_name'];
                $country = $user_detail[0]['country'];
                if (strlen($country) > 2)
                    $data['country_choosen'] = $country;
                else
                    $data['country_choosen'] = false;

                $this->user_model->calucalte_updateUserRank($user_id);

                $user_stats = $this->user_model->getUser_StatsById($user_id);
                $data['total_points'] = $user_stats->points;
                $data['global_rank'] = $user_stats->global_rank;
                $data['u_id']=$user_id;
            } else if ($status === 'false') {
                $data['loggedIn'] = false;
                $data['country_choosen'] = false;
            }
        }

        if(!isset($_GET['c_id'])){
            $cuisine_id=6;
        }
        else
            $cuisine_id=$_GET['c_id'];
        
        $cusine_detail=$this->cuisine_model->getCuisineDetail($cuisine_id);
        
        $data['ranking_type'] = 'Cuisine Ranking';
        $data['cuisine_name']=$cusine_detail->name;
        $data['cuisine_id']=$cuisine_id;
        $data['current_date'] = date('d F Y');
        $data['ranking_data']=$this->getranking(0, 20,'cuisine',null,$cuisine_id);
        $data['total_pages']=$this->user_model->getTotalPages(null,$cuisine_id);
        

        $this->load->view('ranking', $data);
    }
    
    public function getranking($offset=null, $limit=null,$type='global',$country=null,$cuisine_id=null) {
        $return_Value = false;
        if ($offset || $limit) {
            $return_Value = true;
        } else {
            $offset=$_POST['offset'];
            $limit=$_POST['limit'];
            $type=$_POST['ranking_type'];
            $country=$_POST['country'];
            $cuisine_id=$_POST['cuisine_id'];
        }
        
        if($type==='global'){
            $ranking_detail = $this->user_model->calulateGlobalRanking($offset, $limit);
        }
        else if($type==='cuisine'){
            $ranking_detail = $this->user_model->calculateCuisineRanking($cuisine_id,$offset, $limit);
        }
        else {
            $ranking_detail = $this->user_model->calculateCountryRanking($offset, $limit,$country);
        }
        
        $ranking_data=  json_encode($ranking_detail);
        
        if($return_Value){
            return $ranking_data;
        }
        
        echo $ranking_data;
    }

}
