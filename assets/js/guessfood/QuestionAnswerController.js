/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var QuestionAnswerController = {
    current_question_type: null,
    current_question_recipie: null,
    current_question: null,
    fetchQuestion: function() {
        var success = function(data) {
            DataActionController.disableAjaxmask();
            if (data.no_question) {
                QuestionAnswerController.displayNoQuestionMessage(data);
            }
            else
                QuestionAnswerController.displayQuestion(data);
        };
        var url = 'question_answer/fetchquestion';
        var data = {}
        DataActionController.SendAjaxRequest(data, 'POST', 'json', url, success);
    },
    displayNoQuestionMessage: function(data) {
        var question_title = document.getElementById('question_title');
        if (question_title)
            question_title.innerHTML = data.message;

        var question_background_image = document.getElementById('question_background_image');
        if (question_background_image) {
            question_background_image.style.backgroundImage = 'url(assets/images/recipie/no_question.jpg)';
        }

        var tmp_choice_parent = document.getElementById('tmp_choice_parent');
        if (tmp_choice_parent)
            tmp_choice_parent.parentNode.removeChild(tmp_choice_parent);

        var question_choices = document.getElementById('question_choices');
        tmp_choice_parent = document.createElement('div');
        tmp_choice_parent.id = 'tmp_choice_parent';
        question_choices.appendChild(tmp_choice_parent);

        var answer_button = document.getElementById('answer_button');
        if (answer_button) {
            var tmp_answer_button = document.getElementById('tmp_answer_button');
            if (tmp_answer_button)
                tmp_answer_button.parentNode.removeChild(tmp_answer_button);

            tmp_answer_button = document.createElement('div');
            tmp_answer_button.id = 'tmp_answer_button';

            answer_button.appendChild(tmp_answer_button);
        }
    },
    displayQuestion: function(data) {
        this.choices_ids = null;
        this.choices_ids = new Array();

        this.current_question_recipie = data.recipie;
        this.current_question = data.question;

        this.changeQuestionBackgroundImage();

        if (data.question.question_type_id === '1')
            this.current_question_type = 'singleoption'
        else
            this.current_question_type = 'multipleoption'

        var question_title = document.getElementById('question_title');
        if (question_title)
            question_title.innerHTML = data.question.question + ' ?';

        var question_choices = document.getElementById('question_choices');
        if (question_choices) {

            var question_special_msg = document.getElementById('question_special_msg');//hint
            if (question_special_msg) {
                if (this.current_question_type !== 'multipleoption') {
                    question_special_msg.innerHTML = '';
                }
            } else {
                if (this.current_question_type === 'multipleoption') {
                    question_special_msg = document.createElement('div');
                    question_special_msg.id = 'question_special_msg';
                    question_special_msg.innerHTML = '* You can choose more than one option!';
                    question_special_msg.className = 'question_hint';

                    var firstChild = question_choices.firstChild;
                    if (firstChild) {
                        question_choices.insertBefore(question_special_msg, firstChild);
                    } else
                    {
                        question_choices.appendChild(question_special_msg);
                    }
                }
            }

            var tmp_choice_parent = document.getElementById('tmp_choice_parent');
            if (tmp_choice_parent)
                tmp_choice_parent.parentNode.removeChild(tmp_choice_parent);

            tmp_choice_parent = document.createElement('div');
            tmp_choice_parent.id = 'tmp_choice_parent';
            question_choices.appendChild(tmp_choice_parent);

            var div, h4, label, input, span, id;
            for (var choice in data.choices) {
                choice = data.choices[choice];

                div = document.createElement('div');
                h4 = document.createElement('h4');
                div.appendChild(h4);
                label = document.createElement('label');
                h4.appendChild(label);
                input = document.createElement('input');
                input.className = 'iswitch';
                input.type = 'checkbox';
                id = 'choice_' + choice.question_multiple_choice_id;
                input.id = id;
                this.choices_ids.push(id);
                input.setAttribute('onclick', 'QuestionAnswerController.createDataActionOfChoices(' + input.id + ')');
//                input.onclick=function(){DataActionController.dataaction('selectanswer-' + input.id);};
                label.appendChild(input);
                span = document.createElement('span');
                span.innerHTML = choice.choice;
                label.appendChild(span);

                tmp_choice_parent.appendChild(div);

            }



            div = document.createElement('div');
            div.className = '';
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'btn btn-default';
            button.setAttribute('onclick', 'QuestionAnswerController.SubmitAnswer()');
            div.appendChild(button);
            span = document.createElement('span');
            span.innerHTML = 'Submit';
            button.appendChild(span);

            var answer_button = document.getElementById('answer_button');
            if (answer_button) {
                var tmp_answer_button = document.getElementById('tmp_answer_button');
                if (tmp_answer_button)
                    tmp_answer_button.parentNode.removeChild(tmp_answer_button);

                tmp_answer_button = document.createElement('div');
                tmp_answer_button.id = 'tmp_answer_button';

                tmp_answer_button.appendChild(div);
                answer_button.appendChild(tmp_answer_button);
            }
        }

    },
    createDataActionOfChoices: function(ele) {
        var action = ele.id;
        action = 'selectanswer-' + action;
        DataActionController.dataaction(action);
    },
    changeQuestionBackgroundImage: function() {
        var image = this.current_question_recipie.image_link;
        var question_background_image = document.getElementById('question_background_image');
        if (question_background_image) {
            question_background_image.style.backgroundImage = 'url(' + image + ')';
        }
    },
    selectAnswer: function(id) {

        if (this.current_question_type === 'singleoption') {
            for (var choice in this.choices_ids) {
                choice = this.choices_ids[choice];
                choice = document.getElementById(choice);
                if (choice) {
                    if (choice.id !== id) {
                        choice.checked = false;
                    }
                }
            }
        }
    },
    SubmitAnswer: function() {
        var valid = false;
        var selected_ids = new Array();
        var id;
        for (var choice in this.choices_ids) {
            choice = this.choices_ids[choice];
            choice = document.getElementById(choice);
            if (choice) {
                if (choice.checked) {
                    id = choice.id.split('_')[1];
                    selected_ids.push(id);
                    valid = true;
                }
            }
        }
        if (!valid) {
            alert('You must choose atleast one option!');
            return;
        }

        if (!UserController.user_loggedIn)
        {
            alert('Please Sign-in / Register !');
            return;
        }

        var question_id = this.current_question.question_id;

        var success = function(data) {
            DataActionController.disableAjaxmask();
            QuestionAnswerController.refreshQuestion(data);

            console.log(data);
        };
        var url = 'question_answer/useranswered';
        var data = {
            selected_choices: selected_ids,
            question_id: question_id,
            recipie_id: this.current_question_recipie.recipie_id,
            cuisine_id: this.current_question_recipie.cuisine_id
        };
        DataActionController.SendAjaxRequest(data, 'POST', 'json', url, success);
    },
    refreshQuestion: function(data) {
        this.displayLastRecipieInformation();
        this.fetchQuestion();
        this.displayLastQuizResult(data);
        this.displayAdz();
    },
    displayLastRecipieInformation: function() {
        var last_recipie = document.getElementById('last_recipie');
        if (last_recipie)
        {
            var row_LastRecipe = document.getElementById('row_LastRecipe');
            if (row_LastRecipe)
                row_LastRecipe.parentNode.removeChild(row_LastRecipe);

            row_LastRecipe = document.createElement('div');
            row_LastRecipe.className = 'row LastRecipe';
            row_LastRecipe.id = 'row_LastRecipe';

            var col_xs_3 = document.createElement('div');
            col_xs_3.className = 'col-xs-3';
            row_LastRecipe.appendChild(col_xs_3);
            var ahref = document.createElement('a');
            ahref.href = '#';
            col_xs_3.appendChild(ahref);
            var img = document.createElement('img');
            img.src = this.current_question_recipie.image_link;
            img.className = 'img-responsive img-rounded full-width';
            img.setAttribute('alt', 'recipie image');
            ahref.appendChild(img);

            var col_xs_9 = document.createElement('div');
            col_xs_9.className = 'col-xs-9';
            row_LastRecipe.appendChild(col_xs_9);
            var strong = document.createElement('strong');
            strong.innerHTML = this.current_question_recipie.name;
            col_xs_9.appendChild(strong);
            var span = document.createElement('span');
            span.className = 'ReviewRight Review ';
            col_xs_9.appendChild(span);
            var p = document.createElement('p');
            p.innerHTML = this.current_question_recipie.description;
            col_xs_9.appendChild(p);

            last_recipie.appendChild(row_LastRecipe);
        }
    },
    displayLastQuizResult: function(data) {
        var result_of_quiz = document.getElementById('result_of_quiz');
        if (result_of_quiz) {
            var row_AnswerBlock = document.getElementById('row_AnswerBlock');
            if (row_AnswerBlock)
                row_AnswerBlock.parentNode.removeChild(row_AnswerBlock);

            var classname = 'row AnswerBlock ';
            var number_class;
            var point_format;
            if (data.result) {
                classname += 'AnswerBlockCorrect';
                number_class = 'fa-check';
                point_format = 'Correct! (' + data.point + ')';
            }
            else {
                classname += 'AnswerBlockWrong';
                number_class = 'fa-remove';
                point_format = 'False (' + data.point + ')';
            }

            row_AnswerBlock = document.createElement('div');
            row_AnswerBlock.className = classname;
            row_AnswerBlock.id = 'row_AnswerBlock';

            var p = document.createElement('p');
            row_AnswerBlock.appendChild(p);
            var i = document.createElement('i');
            i.className = number_class;
            p.appendChild(i);
            var span = document.createElement('span');
            span.innerHTML = point_format;
            p.appendChild(span);

            span = document.createElement('span');
            span.innerHTML = data.message;
            row_AnswerBlock.appendChild(span);

            result_of_quiz.appendChild(row_AnswerBlock);
        }

        UserController.updateTopUserPoints(data.total_points,data.global_rank);
    },
    displayAdz: function(other_than_home) {
        var imaget_start='';
        if(other_than_home)
            imaget_start='../../';
            
        var right_col_without_Adz = document.getElementById('right_col_without_Adz');
        if (right_col_without_Adz)
            right_col_without_Adz.parentNode.removeChild(right_col_without_Adz);

        var right_col_Adz = document.getElementById('right_col_Adz');
        if (right_col_Adz) {
            var right_col_336 = document.getElementById('right_col_336');
            if (right_col_336)
                right_col_336.parentNode.removeChild(right_col_336);

            right_col_336 = document.createElement('div');
            right_col_336.className = 'advertising';
            right_col_336.id = 'right_col_336';
            right_col_Adz.appendChild(right_col_336);

            var img = document.createElement('img');
            img.src = imaget_start+'assets/images/adz/336x280.gif';
            img.setAttribute('alt', 'advertisement');
            right_col_336.appendChild(img);

        }
    }
};

window.QuestionAnswerController = QuestionAnswerController;
