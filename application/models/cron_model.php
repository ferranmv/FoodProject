<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cron_model
 *
 * @author RashFlash
 */
class cron_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function getTopGlobalUsers($top, $start_date, $end_date) {
        $query = 'select sum(point) as points,user_id from user_question_answered' .
                ' where created_ts between ? and ?' .
                ' group by user_id order by points desc limit 0,?';

        $result = $this->db->query($query, array($start_date, $end_date, $top));

        $final_array = array();

        foreach ($result->result() as $row) {
            $final_array[] = $row;
        }

        return $final_array;
    }

    public function getTopCuisineUsers($top, $start_date, $end_date) {
        $query = 'select sum(point) as points,user_id from user_question_answered' .
                ' where created_ts between ? and ?' .
                ' and question_id in(select question_id from question where recipie_id in(select recipie_id from recipie where cuisine_id=5))' .
                ' group by user_id' .
                ' order by points desc limit 0,?';

        $result = $this->db->query($query, array($start_date, $end_date, $top));

        $final_array = array();

        foreach ($result->result() as $row) {
            $final_array[] = $row;
        }

        return $final_array;
    }

    public function allocateGlobalBadges($type, $users_array) {

        if ($type === 'daily') {
            $badge_type_id = 1;
        } else if ($type === 'weekly') {
            $badge_type_id = 2;
        } else if ($type === 'monthly') {
            $badge_type_id = 3;
        }
        $position = 1;
        foreach ($users_array as $user_record) {
            $user_id = $user_record->user_id;
            if ($position < 4) {
                $badge = $this->getchBadgeByPosition_BadgeTypeId($position, $badge_type_id);
                $this->insertUserBadge($user_id, $badge->badge_id);
            } else {
                $badge = $this->getchBadgeByPosition_BadgeTypeId(25, $badge_type_id);
                $this->insertUserBadge($user_id, $badge->badge_id);
            }
            $json_properties = json_encode(array(
                'badge_id' => $badge->badge_id,
                'badge_type_id' => $badge_type_id,
                'badge_type_name' => $type . " global winner",
                'name' => ' Won a Badge ',
                'title' => $badge->name,
                'image_link' => $badge->image_link,
                'position' => $position
            ));

            $this->user_model->insertUserActivity($user_id, 3, $json_properties, null, null);
            $position++;
        }
    }

    public function insertUserBadge($user_id, $badge_id) {
        $date = date('Y-m-d H:i:s');

        $data = array(
            'user_id' => $user_id,
            'badge_id' => $badge_id,
            'created_ts' => $date,
            'updated_ts' => $date
        );

        $this->db->insert('user_badge', $data);
    }

    public function getchBadgeByPosition_BadgeTypeId($position, $type_id) {
        $query = 'select * from badge where position=? and badge_type_id=?';
        $result = $this->db->query($query, array($position, $type_id));

        return $result->first_row();
    }

}
