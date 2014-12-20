<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of question_answer_model
 *
 * @author RashFlash
 */
class question_answer_model extends CI_Model {

    public function alreadyAnsweredThisQuestion($question_id, $user_id) {
        $query = $this->db->get_where('user_question_answered', array('user_id' => $user_id, 'question_id' => $question_id));

        return $query;
    }

    public function getQuestionDetail($question_id) {
        $query = 'SELECT * FROM question where question_id="' . $question_id . '"';

        $result = $this->db->query($query);
        $row = $result->first_row();

        return $row;
    }

    public function getQuestionLevelDetail($question_level_id) {
        $query = 'SELECT * FROM question_level where question_level_id="' . $question_level_id . '"';

        $result = $this->db->query($query);
        $row = $result->first_row();

        return $row;
    }

    public function getQuestionLevelDetailByQuestion_Id($question_id) {
        $query = 'select * from question_level where question_level_id=(select question_level_id from question where question_id="' . $question_id . '")';

        $result = $this->db->query($query);
        $row = $result->first_row();

        return $row;
    }

    public function getRandomQuestion($user_id) {
        $enabled = 'T';

        $query = 'select * from question where enabled="' . $enabled . '" and question_id NOT IN (select question_id from user_question_answered where user_id="' . $user_id . '")';

        $result = $this->db->query($query);
        $count = $result->num_rows();
        $radom_rows_id = rand(0, $count - 1);
        $row = $result->row($radom_rows_id);

        return $row;
    }

    public function getquestionchoices($question_id) {
        $query = 'SELECT question_multiple_choice_id,choice FROM question_multiple_choice where question_id="' . $question_id . '"';
        $result = $this->db->query($query);

        $choices = array();
        if ($result->num_rows() > 1) {
            foreach ($result->result() as $rows) {
                $choices[] = $rows;
            }
        }

        return $choices;
    }

    public function fetchrecipieById($id) {
        $query = 'SELECT * FROM recipie where recipie_id="' . $id . '"';
        $result = $this->db->query($query);
        $row = $result->first_row();

        return $row;
    }
    
    public function fetchrecipieByTitle($title) {
        $query = 'SELECT * FROM recipie where name="' . $title . '"';
        $result = $this->db->query($query);
        $row = $result->first_row();

        return $row;
    }
    
    public function makeUrlFromTitle($title){
        $title = str_replace(' ', '-', $title);      
        return $title;
    }
    
    public function getTitleFromUrl($url){
        $url = str_replace('-', ' ', $url);      
        return $url;
    }

    public function matchUserAnswer($question_id, $user_choices) {
        $correct = 'T';
        $query = 'select * from question_multiple_choice where question_id=' . $question_id . ' and correct="' . $correct . '"';
        $result = $this->db->query($query);

        $choices = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $rows) {
                $choices[] = $rows->question_multiple_choice_id;
            }
        }

        $u_count = count($user_choices);
        $c_count = count($choices);
        if ($u_count === $c_count) {

            $match_count = 0;
            foreach ($choices as $choice) {
                foreach ($user_choices as $u_choice) {
                    if ($u_choice === $choice) {
                        $match_count++;
                    }
                }
            }

            if ($match_count === $c_count)
                return true;
            else
                return false;
        } else
            return false;
    }

    public function UpdateUserPoints($question_id, $user_id, $result, $cuisine_id, $question_level_detail, $choice_ids) {
        $date = date('Y-m-d H:i:s');
        $point;
        $message;
        $q_r=0;
        $q_w=0;
        if ($result) {
            $point = (int) $question_level_detail->point_awarded;
            $value = "T";
            $message = 'Your answer is correct';
            $q_r=1;
        } else {
            $point = (int) $question_level_detail->point_deducted;
            $point = $point * (-1);
            $value = "F";
            $message = 'Your answer is wrong! better luck next time';
            $q_w=1;
        }

        $data = array(
            'user_id' => $user_id,
            'question_id' => $question_id,
            'choice_id' => $choice_ids,
            'result' => $value,
            'point' => $point,
            'created_ts' => $date,
            'updated_ts' => $date
        );
        $this->db->insert('user_question_answered', $data);


        $query = 'update user_stats set updated_ts="' . $date . '", points=points+' . $point . ',question_right=question_right+'.$q_r.',question_wrong=question_wrong+'.$q_w.' where user_id="' . $user_id . '"';
        $result = $this->db->query($query);


        $query = 'select * from user_cuisine_point where user_id="' . $user_id . '" and cuisine_id="' . $cuisine_id . '"';
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $query = 'update user_cuisine_point set updated_ts="' . $date . '", point=point+' . $point . ' where user_id="' . $user_id . '" and cuisine_id="' . $cuisine_id . '"';
            $result = $this->db->query($query);
        } else {
            $data = array(
                'user_id' => $user_id,
                'cuisine_id' => $cuisine_id,
                'point' => $point,
                'created_ts' => $date,
                'updated_ts' => $date
            );
            $this->db->insert('user_cuisine_point', $data);
        }

        return array(
            'point' => $point,
            'message' => $message
        );
    }

    public function create_default_recipie_questions() {
        $question = array(
            '0' => 'What is the name of this recipie',
            '1' => 'What is the main ingredient of this recipie',
            '2' => 'What type of cuisine is this recipe'
        );

        $query = 'select * from recipie where recipie_id NOT IN (select recipie_id from question )';
        $result = $this->db->query($query);

        $question_type_id = 1;
        $choices = 4;
        $question_level_id = 1;

        if ($result->num_rows() > 0) {
            foreach ($result->result() as $rows) {
                $recipie_id = $rows->recipie_id;

                //////////////////////////////////
                $question_text = $question['0'];
                $question_id = $this->create_question($question_level_id, $question_type_id, $question_text, $choices, $recipie_id, 'T');
                $random_recipies = $this->getRandomTopRecipies($choices - 1, $recipie_id);
                $random_choice_place = rand(0, $choices - 1);

                $j = 0;
                for ($i = 0; $i < $choices; $i++) {
                    if ($i === $random_choice_place) {
                        $this->create_question_multiple_choice($question_id, $rows->name, 'T');
                    } else {
                        $this->create_question_multiple_choice($question_id, $random_recipies[$j]->name, 'F');
                        $j++;
                    }
                }

                //////////////////////////////////
                $question_text = $question['1'];

                $main_ingredients = $this->getMainIngredientsOfRecipie($recipie_id);
                $count_ingre = count($main_ingredients);
                if ($count_ingre > 1) {
                    $question_type_id = 2;
                }

                $question_id = $this->create_question($question_level_id, $question_type_id, $question_text, $choices, $recipie_id, 'T');

                if ($question_type_id > 1) {
                    $random_ingredient = $this->getRandomTopIngredients($choices - $count_ingre, $main_ingredients, true);
                    
                    for ($i = 0; $i < ($choices-$count_ingre); $i++) {                      
                            $this->create_question_multiple_choice($question_id, $random_ingredient[$i]->name, 'F');                                                
                    }
                    for($i = 0; $i < $count_ingre; $i++){
                         $main_ingredient_detail = $this->getIngredentDetail($main_ingredients[$i]->ingredient_id);
                        $this->create_question_multiple_choice($question_id, $main_ingredient_detail->name, 'T');
                    }
                } else {
                    $random_ingredient = $this->getRandomTopIngredients($choices - 1, $main_ingredients[0]->ingredient_id);
                    $main_ingredient_detail = $this->getIngredentDetail($main_ingredients[0]->ingredient_id);
                    $random_choice_place = rand(0, $choices - 1);
                    $j = 0;
                    for ($i = 0; $i < $choices; $i++) {
                        if ($i === $random_choice_place) {
                            $this->create_question_multiple_choice($question_id, $main_ingredient_detail->name, 'T');
                        } else {
                            $this->create_question_multiple_choice($question_id, $random_ingredient[$j]->name, 'F');
                            $j++;
                        }
                    }
                }


                ///////////////////////////////////
                $question_type_id = 1;
                $question_text = $question['2'];                
                 
                $question_id = $this->create_question($question_level_id, $question_type_id, $question_text, $choices, $recipie_id, 'T');
                $random_cusines = $this->getRandomTopCuisines($choices - 1, $rows->cuisine_id);
                $random_choice_place = rand(0, $choices - 1);

                $j = 0;
                for ($i = 0; $i < $choices; $i++) {
                    if ($i === $random_choice_place) {
                        $cuisine_detail=$this->getCuisineDetail($rows->cuisine_id);
                        $this->create_question_multiple_choice($question_id, $cuisine_detail->name, 'T');
                    } else {
                        $this->create_question_multiple_choice($question_id, $random_cusines[$j]->name, 'F');
                        $j++;
                    }
                }
                
                ///////////////////////////////////
            }
        }
    }

    public function getIngredentDetail($id) {
        $query = 'select * from ingredient where ingredient_id = "' . $id . '"';
        $result = $this->db->query($query);
        return $result->first_row();
    }
    
     public function getCuisineDetail($id) {
        $query = 'select * from cuisine where cuisine_id = "' . $id . '"';
        $result = $this->db->query($query);
        return $result->first_row();
    }

    public function getMainIngredientsOfRecipie($recipie_id) {
        $main = 'T';
        $query = 'select * from recipie_ingredient where main_ingredient="' . $main . '" and recipie_id = "' . $recipie_id . '"';
        $result = $this->db->query($query);
        $final_array = array();
        foreach ($result->result() as $row) {
            $final_array[] = $row;
        }

        return $final_array;
    }

    public function getRandomTopRecipies($top_count, $other_than = null) {
        if ($other_than) {
            $query = 'select * from recipie where recipie_id <> "' . $other_than . '" ORDER BY RAND() limit ' . $top_count;
        } else {
            $query = 'select * from recipie ORDER BY RAND() limit ' . $top_count;
        }

        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $final_array = array();
            foreach ($result->result() as $row) {
                $final_array[] = $row;
            }
        }

        return $final_array;
    }
    
      public function getRandomTopCuisines($top_count, $other_than = null) {
        if ($other_than) {
            $query = 'select * from cuisine where cuisine_id <> "' . $other_than . '" ORDER BY RAND() limit ' . $top_count;
        } else {
            $query = 'select * from cuisine ORDER BY RAND() limit ' . $top_count;
        }

        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $final_array = array();
            foreach ($result->result() as $row) {
                $final_array[] = $row;
            }
        }

        return $final_array;
    }

    public function getRandomTopIngredients($top_count, $other_than = null, $isarray = false) {
        if ($isarray) {
            $str='';
            foreach($other_than as $ingredeint){
                if(strlen($str)<1)
                    $str=$str.$ingredeint->ingredient_id;
                else
                    $str=$str.','.$ingredeint->ingredient_id;
            }
            
             $query = 'select * from ingredient where ingredient_id NOT IN ("' . $str . '") ORDER BY RAND() limit ' . $top_count;
            
        } else {
            if ($other_than) {
                $query = 'select * from ingredient where ingredient_id <> "' . $other_than . '" ORDER BY RAND() limit ' . $top_count;
            } else {
                $query = 'select * from ingredient ORDER BY RAND() limit ' . $top_count;
            }
        }

        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $final_array = array();
            foreach ($result->result() as $row) {
                $final_array[] = $row;
            }
        }

        return $final_array;
    }

    public function create_question($level_id, $type_id, $question, $total_choices, $recipie_id, $enabled) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'question_level_id' => $level_id,
            'recipie_id' => $recipie_id,
            'question_type_id' => $type_id,
            'question' => $question,
            'enabled' => $enabled,
            'total_choices' => $total_choices,
            'created_ts' => $date,
            'updated_ts' => $date
        );

        $this->db->insert('question', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function create_question_multiple_choice($question_id, $choice, $correct) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'question_id' => $question_id,
            'choice' => $choice,
            'correct' => $correct,
            'created_ts' => $date,
            'updated_ts' => $date
        );

        $this->db->insert('question_multiple_choice', $data);
    }

}
