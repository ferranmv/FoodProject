<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cuisine_model
 *
 * @author RashFlash
 */
class facebook_model extends CI_Model {

   public function getLinkFacebookdetail_fqlquery($url) {
            $fql = "SELECT url, share_count, like_count, comment_count, ";
            $fql .= "total_count, click_count FROM ";
            $fql .= "link_stat WHERE url =' {$url}'";

            $apifql = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);
            $response = file_get_contents($apifql);
            
             $response = json_decode($response);             
            
             return $response[0];
        }

}
