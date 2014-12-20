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
class cuisine_model extends CI_Model {

    public function getAllCuisines() {
        $query = $this->db->get('cuisine');

        if ($query->num_rows() < 1)
            return false;

        $result = array();
        $i = 0;
        foreach ($query->result() as $row) {
            $result[$i] = $row;
            $i++;
        }

        return $result;
    }

    public function getCuisineDetail($id) {
        $query = 'Select * from cuisine where cuisine_id=?';
        $result = $this->db->query($query, array($id));
        return $result->first_row();
    }

    public function getCuisineDetailByName($name) {
        $query = 'Select * from cuisine where name=?';
        $result = $this->db->query($query, array($name));
        return $result->first_row();
    }

    public function getAllRecipiesinCuisine($cuisine_id) {
        $query = 'Select * from recipie where cuisine_id=?';
        $result = $this->db->query($query, array($cuisine_id));

        $final_array = array();
        foreach ($result->result() as $row) {
            $final_array[] = $row;
        }

        return $final_array;
    }

}
