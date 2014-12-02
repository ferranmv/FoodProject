<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cron
 *
 * @author RashFlash
 */
class cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cron_model');
    }

    public function dailyGlobalBadges() {
        $current_date = date('Y-m-d H:i:s');
        $lastDate = new DateTime();
        $lastDate->sub(new DateInterval('P1D'));

        $start_date = $lastDate->format('Y-m-d H:i:s');
        
        $result=$this->cron_model->getTopGlobalUsers(25,$start_date,$current_date);
        $this->cron_model->allocateGlobalBadges('daily',$result);
    }

    public function weeklyGlobalBadges() {
        $current_date = date('Y-m-d H:i:s');
        $lastDate = new DateTime();
        $lastDate->sub(new DateInterval('P7D'));

        $start_date = $lastDate->format('Y-m-d H:i:s');
        $result=$this->cron_model->getTopGlobalUsers(25,$start_date,$current_date);
        $this->cron_model->allocateGlobalBadges('weekly',$result);
    }

    public function monthlyGlobalBadges() {
        $current_date = date('Y-m-d H:i:s');
        $lastDate = new DateTime();
        $lastDate->sub(new DateInterval('P1M'));

        $start_date = $lastDate->format('Y-m-d H:i:s');
        $result=$this->cron_model->getTopGlobalUsers(25,$start_date,$current_date);
        $this->cron_model->allocateGlobalBadges('monthly',$result);
    }

}
