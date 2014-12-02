/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var DataActionController = {
    dataaction: function(action) {
        var action = action.split('-');
        var task = action[0];
        var data = action[1];
        DataActionController[task](data);
    },
    login: function(data) {
        this.enableAjaxmask();
        if (data === 'facebook')
        {
            FacebookController.checkAlreadyLogedIn();
        }
    },
    logout:function(data){
        this.facebooklogout();
    },
    facebooklogout:function(){
        var success=function(data){     
            FacebookController.Logout();           
        };    
        var url='login/userloggedout'
        var data={}
        this.SendAjaxRequest(data, 'POST', 'json', url, success); 
    },
    usercountry: function() {
        var country_list = document.getElementById('country_list');
        var choosen_country = country_list.value;
        if (choosen_country) {
            var success = function(data) {
                DataActionController.disableAjaxmask();
            };
            var url = 'user/choosecountry'
            var data = {
                country: choosen_country
            };
            this.SendAjaxRequest(data, 'POST', 'json', url, success);
        }
        MiscController.destroyChooseCountryPopup();
    },
    facebookLogin: function(response) {
        var success = function(data) {
//            console.log(data);
            UserController.user_loggedIn=true;
            DataActionController.disableAjaxmask();
            UserController.createUserProfile(data);
            UserController.removeplay_login_btn();
        };
        var url = 'login/facebooklogin'
        var data = {
            response: response,
            system_country:UserController.SystemDetectedCountry
        };
        this.SendAjaxRequest(data, 'POST', 'json', url, success);
    },
    fetchUserTimeLine: function(limit,offset,activity_type_id,uid) {
        UserController.current_activity_type_id=activity_type_id;
        UserController.uid=uid;
        UserController.last_offset=offset;
        UserController.last_limit=limit;
        var success = function(data) {
            DataActionController.disableAjaxmask();
           UserController.createUserTimeLine(data);
        };
        var url = 'user/profiletimeline';
        var data = {
            limit: limit,
            offset: offset,
            activity_type_id: activity_type_id,
            uid: uid
        };
        this.SendAjaxRequest(data, 'POST', 'json', url, success);
    },
    selectanswer:function(id){
        QuestionAnswerController.selectAnswer(id);
    },
    submitanswer:function(){
        QuestionAnswerController.SubmitAnswer();
    },
    disableAjaxmask: function() {
        var ajaxOverlay = document.getElementById('ajaxOverlay');
        if (ajaxOverlay)
            ajaxOverlay.style.display = 'none';

        this.disableAjaxLoader();

        this.changeMouseCursor('default');
    },
    enableAjaxmask: function() {
        var ajaxOverlay = document.getElementById('ajaxOverlay');
        if (ajaxOverlay)
            ajaxOverlay.style.display = 'block';

        this.enableAjaxLoader();

        this.changeMouseCursor('wait');
    },
    enableAjaxLoader: function() {
        var ajax_loader = document.getElementById('ajax_loader');
        if (ajax_loader)
            ajax_loader.style.display = 'block';
    },
    disableAjaxLoader: function() {
        var ajax_loader = document.getElementById('ajax_loader');
        if (ajax_loader)
            ajax_loader.style.display = 'none';
    },
    changeMouseCursor: function(type) {
        var body = document.getElementsByTagName('body')[0];
        if (!type)
            type = 'default';

        if (type === 'colorfill') {
            type = 'url("images/icons/colorfillcursor.png"),auto';
        }

        body.style.cursor = type;
    },
    SendAjaxRequest: function(data, type, datatype, url, success_callback) {
        this.enableAjaxmask();
        $.ajax({
            type: type,
            url: baseurl + url,
            dataType: datatype,
            data: data,
            cache: false,
            success:
                    function(data) {
//                        EventHandler.disableAjaxmask();
                        success_callback(data);
                    },
            error:
                    function(data) {
                        if (data.status === 200) {
//                            EventHandler.disableAjaxmask();
                            success_callback(data);
                        }
                        else {
                            console.log(data);
                        }
                    }

        });
    },
    setBaseUrl: function(url) {
        window.baseurl = url;
    }
};

window.DataActionController = DataActionController;