<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of question_answer
 *
 * @author RashFlash
 */
class question_answer extends CI_Controller {

    private $CI_Session;

    public function __construct() {
        parent::__construct();
        $this->load->model('question_answer_model');
        $this->load->model('user_model');
        $this->CI_Session = new session_helper();
    }

    public function fetchquestion() {
        $user_id = $this->CI_Session->get_session('uid');
        $question = $this->question_answer_model->getRandomQuestion($user_id);
        if (!$question) {
            $data = array(
                'no_question' => true,
                'message' => 'Please visit again to Answer more questions!'
            );
            echo json_encode($data);
        } else {
            $choices = $this->question_answer_model->getquestionchoices($question->question_id);
            $recipie = $this->question_answer_model->fetchrecipieById($question->recipie_id);
            $data = array(
                'question' => $question,
                'choices' => $choices,
                'recipie' => $recipie
            );
            echo json_encode($data);
        }
    }

    public function useranswered() {
        $user_id = $this->CI_Session->get_session('uid');
        $answers = $_POST['selected_choices'];
        $question_id = $_POST['question_id'];
        $recipie_id = $_POST['recipie_id'];
        $cuisine_id = $_POST['cuisine_id'];

        $question_level_detail = $this->question_answer_model->getQuestionLevelDetailByQuestion_Id($question_id);
        $result = $this->question_answer_model->matchUserAnswer($question_id, $answers);

        $point_detail = $this->question_answer_model->UpdateUserPoints($question_id, $user_id, $result, $cuisine_id, $question_level_detail, "1");
               
        $this->user_model->calucalte_updateUserRank($user_id);
        $user_stats = $this->user_model->getUser_StatsById($user_id);
        ////////////////

        $recipie_detail = $this->question_answer_model->fetchrecipieById($recipie_id);
        $description = json_encode($recipie_detail);
        $json_properties = array(
            'recipie_id' => $recipie_id,
            'cuisine_id' => $cuisine_id,
            'question_id' => $question_id,
            'result' => $result,
            'point' => $point_detail['point']
        );
        $json_properties = json_encode($json_properties);
        $this->user_model->insertUserActivity($user_id, 2, $description, null, $json_properties);
        ////////////////
        $data = array(
            'result' => $result,
            'point' => $point_detail['point'],
            'message' => $point_detail['message'],
            'total_points' => $user_stats->points,
            'global_rank' => $user_stats->global_rank
        );
        echo json_encode($data);
    }

    public function createDefaultQuestions() {
        $this->question_answer_model->create_default_recipie_questions();
    }

}
