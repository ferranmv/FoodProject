<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author RashFlash
 */
class user extends CI_Controller {

    private $CI_Session;

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('home_model');
        $this->CI_Session = new session_helper();
    }

    public function choosecountry() {
        $country = $_POST['country'];
        $uid = $this->CI_Session->get_session('uid');
        if ($uid)
            $this->user_model->updateUserTable('country', $country, $uid);

        $data = array(
            'status' => true
        );

        echo json_encode($data);
    }

    public function updateuserprofile(){
        $first_name=strip_tags($_POST['first_name']);
        $last_name=strip_tags($_POST['last_name']);
        $website_link=strip_tags($_POST['website_link']);
        $about_me=strip_tags($_POST['about_me']);
        
        $loggedin_user_id = $this->CI_Session->get_session('uid');
         if (!$loggedin_user_id) {
            $url = $this->config->item('base_url');
            $url = substr($url, 0, -1);
            $this->redirectToPage($url);
            return;
        }
        
        $data=array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'website_link'=>$website_link,
            'about_me'=>$about_me
        );
        
        $this->user_model->updateUserEditProfile($loggedin_user_id,$data);
        
        $data=array(
            'status'=>true
        );
        echo json_encode($data);
    }
    
    public function editprofile() {
        $loggedin_user_id = $this->CI_Session->get_session('uid');

        if (!$loggedin_user_id) {
            $url = $this->config->item('base_url');
            $url = substr($url, 0, -1);
            $this->redirectToPage($url);
            return;
        }

        $user_id = $loggedin_user_id;
        $data['loggedIn'] = true;
        
        $user_stats = $this->user_model->get_userProfile_Stats($user_id);       
        
        $country = $user_stats->country;
            if (strlen($country) > 2)
                $data['country_choosen'] = $country;
            else
                $data['country_choosen'] = false;

        $user_data = array(
            'name' => $user_stats->first_name . ' ' . $user_stats->last_name,
            'picture' => $user_stats->picture,
            'total_points' => $user_stats->points,
            'country_choosen' => $data['country_choosen']
        );

        $result = json_encode($user_data);
        $data['loggedin_user_detail'] = $result;
        $data['user_detail'] = $data['loggedin_user_detail'];
        
        $data['user_profile']=json_encode($user_stats);

        $this->load->view('edit_profile', $data);
        
    }

    public function userprofile() {
        $user_id = false;
        if (isset($_GET['u_id'])) {
            $user_id = $_GET['u_id'];
        } else {
            $loggedin_user_id = $this->CI_Session->get_session('uid');

            if (!$loggedin_user_id) {
                $url = $this->config->item('base_url');
                $url = substr($url, 0, -1);
                $this->redirectToPage($url);
                return;
            }
        }

        if (!$user_id)
            $user_id = $loggedin_user_id;

        if (!isset($loggedin_user_id)) {
            $loggedin_user_id = $this->CI_Session->get_session('uid');
        }

        $user_profile = $this->home_model->getUserById($user_id);

        if (!$user_profile) {
            $url = $this->config->item('base_url');
            $url = substr($url, 0, -1);
            $this->redirectToPage($url);
            return;
        }

        $user_profile = $user_profile->result_array;
        $user_stats = $this->user_model->getUser_StatsById($user_id);



        $status = $this->CI_Session->get_session('status');
        if (!$status) {
            $data['loggedIn'] = false;
            $data['country_choosen'] = false;
        } else if ($status === 'true') {
            $data['loggedIn'] = true;
            $country = $user_profile[0]['country'];
            if (strlen($country) > 2)
                $data['country_choosen'] = $country;
            else
                $data['country_choosen'] = false;
        }
        else {
            $data['loggedIn'] = false;
        }

        $user_data = array(
            'name' => $user_profile['0']['first_name'] . ' ' . $user_profile['0']['last_name'],
            'picture' => $user_profile['0']['picture'],
            'total_points' => $user_stats->points,
            'country_choosen' => $data['country_choosen'],
            'uid' => $user_id
        );

        $result = json_encode($user_data);
        $data['user_detail'] = $result;

        if ($data['loggedIn']) {
            if ($user_id === $loggedin_user_id) {
                $data['loggedin_user_detail'] = $data['user_detail'];
            } else {
                $user_id = $loggedin_user_id;
                $user_profile = $this->home_model->getUserById($user_id);
                $user_profile = $user_profile->result_array;
                $user_stats = $this->user_model->getUser_StatsById($user_id);

                $user_data = array(
                    'name' => $user_profile['0']['first_name'] . ' ' . $user_profile['0']['last_name'],
                    'picture' => $user_profile['0']['picture'],
                    'total_points' => $user_stats->points,
                    'country_choosen' => $data['country_choosen']
                );

                $result = json_encode($user_data);
                $data['loggedin_user_detail'] = $result;
            }
        }

        $activity_types = $this->home_model->getActivityTypes();
        $data['activity_types'] = json_encode($activity_types);

        $this->load->view('profile', $data);
    }

    public function redirectToPage($url) {
        $this->output->set_header("Location: " . $url . "");
//        $this->load->helper('url');       
//        redirect($url, 'location');
    }

    public function profiletimeline() {
        $limit = $_POST['limit'];
        $offset = $_POST['offset'];
        $user_id = $_POST['uid'];
        $activity_type_id = $_POST['activity_type_id'];

        $result = $this->user_model->getUserActivity($user_id, $activity_type_id, $offset, $limit);

        $data = json_encode($result);
        echo $data;
    }

}
