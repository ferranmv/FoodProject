<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author RashFlash
 */
class login extends CI_Controller {

    private $CI_Session;

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->CI_Session = new session_helper();
    }

    public function facebooklogin() {
        $response = $_POST['response'];
        $id = $response['id'];
        $system_detected_country=$_POST['system_country'];

        $result = $this->home_model->checkUserAlreadyExist($id);

        $this->load->model('user_model');

        if (!$result) {
            $user_id = $this->home_model->createNewUser($response);
            $picture = "https://graph.facebook.com/" . $response['id'] . "/picture";
            $name = $response['first_name'] . " " . $response['last_name'];
            $country_choosen=$system_detected_country;

            $this->user_model->updateUserTable('country',$system_detected_country,$user_id);    

            $this->user_model->insertUserActivity($user_id, 6, ' joined this quiz game.', null, null);
        } else {
            $result = $result->result_array;
            $picture = $result[0]['picture'];
            $name = $result[0]['first_name'] . " " . $result[0]['last_name'];
            $user_id = $result[0]['user_id'];

            $country = $result[0]['country'];
            if (strlen($country) > 2) {
                $country_choosen = $country;
            } else {                
                $this->user_model->updateUserTable('country',$system_detected_country,$user_id); 
                $country_choosen=$system_detected_country;
            }
        }

        $this->user_model->calucalte_updateUserRank($user_id);

        $user_stats = $this->user_model->getUser_StatsById($user_id);
        $total_points = $user_stats->points;
        $global_rank = $user_stats->global_rank;

        $this->CI_Session->set_session('status', 'true');
        $this->CI_Session->set_session('uid', $user_id);

        $reply = array(
            'name' => $name,
            'picture' => $picture,
            'country_choosen' => $country_choosen,
            'total_points' => $total_points,
            'global_rank' => $global_rank
        );

        echo json_encode($reply);
    }

    public function userloggedout() {
        $this->CI_Session->clear_session();

        $data = array(
            'status' => true
        );

        echo json_encode($data);
    }

}
