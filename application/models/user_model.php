<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author RashFlash
 */
class user_model extends CI_Model {

    public function updateUserTable($field, $value, $user_id) {
        $data = array(
            $field => $value
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
    }

    public function updateUserEditProfile($user_id, $data_array) {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data_array);
    }

    public function get_userProfile_Stats($user_id) {
        $query = 'select * from user,user_stats where user.user_id=user_stats.user_id and user.user_id="' . $user_id . '"';
        $result = $this->db->query($query);

        $final_reault = $result->first_row();
        return $final_reault;
    }

    public function getUser_StatsById($user_id) {
        $query = 'select * from user_stats where user_id="' . $user_id . '"';
        $result = $this->db->query($query);
        $row = $result->first_row();

        return $row;
    }

    public function insertUserActivity($user_id, $activity_type_id, $description, $image_link, $json_properties) {
        $date = date('Y-m-d H:i:s');

        $data = array(
            'user_id' => $user_id,
            'activity_type_id' => $activity_type_id,
            'description' => $description,
            'image_link' => $image_link,
            'json_properties' => $json_properties,
            'created_ts' => $date,
            'updated_ts' => $date
        );

        $this->db->insert('user_activity', $data);
    }

    public function getUserActivity($user_id, $activity_type_id, $offset, $limit) {
        if ($activity_type_id)
            $query = 'select * from user_activity where user_id="' . $user_id . '" and activity_type_id="' . $activity_type_id . '" order by created_ts DESC Limit ' . $offset . ',' . $limit;
        else
            $query = 'select * from user_activity where user_id="' . $user_id . '" order by created_ts DESC Limit ' . $offset . ',' . $limit;

        $result = $this->db->query($query);
        $final_array = array();
        foreach ($result->result() as $row) {
            $final_array[] = $row;
        }

        return $final_array;
    }

    public function calulateGlobalRanking($offset, $limit) {
        $this->db->query("SET @rownum := 0;");
        $query = "select rank,user_id from(select @rownum := @rownum + 1 AS rank,user_id from user_stats order by points DESC,created_ts ASC)as result limit " . $offset . "," . $limit;

        $result = $this->db->query($query);

        $final_array = array();
        $i = 0;
        foreach ($result->result() as $row) {
            $user_profile_state = $this->get_userProfile_Stats($row->user_id);
            $final_array[$i] = $user_profile_state;
            $final_array[$i]->rank = $row->rank;
            $i++;
        }

        return $final_array;
    }

     public function calculateCuisineRanking($cuisine_id,$offset, $limit) {
        $this->db->query("SET @rownum := 0;");
        
        $query = "select rank,user_id,cuisine_id,point from(select @rownum := @rownum + 1 AS rank,user_id,cuisine_id,point from user_cuisine_point where cuisine_id =? order by point DESC,created_ts ASC)as result limit " . $offset . "," . $limit;
        
         $result = $this->db->query($query,array($cuisine_id));
        
        $final_array = array();
        $i = 0;
        foreach ($result->result() as $row) {
            $user_profile_state = $this->get_userProfile_Stats($row->user_id);
            $final_array[$i] = $user_profile_state;
            $final_array[$i]->rank = $row->rank;
            $final_array[$i]->points=$row->point;
            $i++;
        }

        return $final_array;
    }
    
    public function calculateUserCountryRanking($user_id, $country) {
        $this->db->query("SET @rownum := 0;");
        $query = "select rank,user_id from(select @rownum := @rownum + 1 AS rank,user_id from user_stats"
                . " where user_id in(select user_id from user where country like '$country')"
                . " order by points DESC,created_ts ASC)as result where user_id=" . $user_id;

        $result = $this->db->query($query);
        return $result->first_row();
    }

    public function calculateCountryRanking($offset, $limit, $country) {
        $this->db->query("SET @rownum := 0;");
        $query = "select rank,user_id from(select @rownum := @rownum + 1 AS rank,user_id from user_stats"
                . " where user_id in(select user_id from user where country like '$country')"
                . " order by points DESC,created_ts ASC)as result limit " . $offset . "," . $limit;

        $result = $this->db->query($query);

        $final_array = array();
        $i = 0;
        foreach ($result->result() as $row) {
            $user_profile_state = $this->get_userProfile_Stats($row->user_id);
            $final_array[$i] = $user_profile_state;
            $final_array[$i]->rank = $row->rank;
            $i++;
        }

        return $final_array;
    }

    public function calulateUserGlobalRanking($user_id) {
        $this->db->query("SET @rownum := 0;");
        $query = "select rank,user_id from(select @rownum := @rownum + 1 AS rank,user_id from user_stats order by points DESC,created_ts ASC)as result where user_id=" . $user_id;

        $result = $this->db->query($query);
        return $result->first_row();
    }

    public function updateTableByUserId($table_name, $user_id, $data_array) {
        $this->db->where('user_id', $user_id);
        $this->db->update($table_name, $data_array);
    }

    public function calucalte_updateUserRank($user_id) {
        $user_rank_detail = $this->calulateUserGlobalRanking($user_id);
        $update_array = array(
            'global_rank' => $user_rank_detail->rank
        );
        $this->updateTableByUserId('user_stats', $user_id, $update_array);
    }

    public function getTotalPages($country=null,$cuisine=null) {

        $query = 'SELECT count(*) as user_count FROM user ';
        if($country)
            $query = 'SELECT count(*) as user_count FROM user where country like "'.$country.'"';
        else if($cuisine)
            $query='select count(*)as user_count from user_cuisine_point where cuisine_id="'.$cuisine.'"';
        
        $result = $this->db->query($query);

        $row = $result->first_row();

        $pages = $row->user_count / 20;
        $pages=  ceil($pages);
        return $pages;
    }

}
