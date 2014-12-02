<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of welcome
 *
 * @author RashFlash
 */
class home_model extends CI_Model{
    //put your code here
    public function insert_user($name,$city){
        $data=array(
            'name'=>$name,
            'city'=>$city
        );
        $this->db->insert('users',$data);
        $id=$this->db->insert_id();
        return $id;
    }
    
    public function getPageStartedData(){
        
    }
    
    public function checkUserAlreadyExist($facebook_id){
        $query = $this->db->get_where('user', array('facebook_id' => $facebook_id));
        $result=$query->row_array();
        
        if(!$result)
            return false;
        
        return $query;
    }
    
     public function getUserById($user_id){
        $query = $this->db->get_where('user', array('user_id' => $user_id));
        $result=$query->row_array();
        
        if(!$result)
            return false;
        
        return $query;
    }
    
    public function createNewUser($response){
        $date=date('Y-m-d H:i:s');
        
         $data=array(
            'first_name'=>$response['first_name'],
            'last_name'=>$response['last_name'],
             'email'=>$response['email'],
             'join_date'=>$date,
             'country'=>'',
             'city'=>'',
             'facebook_id'=>$response['id'],
             'picture'=>"https://graph.facebook.com/" . $response['id'] . "/picture",
             'gender'=>$response['gender'],
             'verified'=>$response['verified'],
             'facebook_link'=>$response['link'],
             'created_ts'=>$date,
             'updated_ts'=>$date
        );
        $this->db->insert('user',$data);
        $id=$this->db->insert_id();
        
        $data=array(
            'user_id'=>$id,            
             'created_ts'=>$date,
             'updated_ts'=>$date
        );
        $this->db->insert('user_stats',$data);
        
        return $id;
    }
    
    public function getActivityTypes($id=null){
        $enable='T';
        if(!$id){
            $query='select * from activity_type where enable="'.$enable.'"';
        }else{
            $query='select * from activity_type where enable="'.$enable.'" and activity_type_id="'.$id.'"';
        }
        
        $result=$this->db->query($query);
        
        $final_array=array();
        foreach($result->result() as $row){
            $final_array[]=$row;
        }
        
        return $final_array;
    }
}
