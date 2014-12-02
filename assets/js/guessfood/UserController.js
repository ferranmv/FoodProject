/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var UserController = {
    current_profile_user: null,
    FieldVerifications: function(elements) {
        var error_message = '';
        var error = false;
        if (this.verifyNameFields(elements.first_name.value)) {

        }
        else {
            error = true;
            error_message += 'First name must be a string with atleast 2 characters! \n\n';
        }

        if (this.verifyNameFields(elements.last_name.value)) {

        }
        else {
            error = true;
            error_message += 'Last name must be a string with atleast 2 characters! \n\n';
        }

        if (this.verifyLinkFields(elements.website_link.value)) {

        }
        else {
            error = true;
            error_message += 'Website address is too short! \n\n';
        }

        if (this.verifyTextDescriptionFields(elements.about_me.value)) {

        }
        else {
            error = true;
            error_message += 'About me should contain atleast 5 characters! \n\n';
        }


        return {
            'message': error_message,
            'error_flag': error
        };
    },
    updateEditProfileFields: function() {
        var edit_profile_form = document.getElementById('edit_profile_form');
        var elements = edit_profile_form.elements;
        var first_name, last_name, website_link, about_me;

        var verification = this.FieldVerifications(elements);
        if (verification.error_flag) {
            alert(verification.message);
        }
        else {
            var success = function(data) {
                DataActionController.disableAjaxmask();
                console.log(data);
            };
            var url = 'user/updateuserprofile'
            var data = {
                first_name: elements.first_name.value,
                last_name: elements.last_name.value,
                website_link: elements.website_link.value,
                about_me: elements.about_me.value
            };
            DataActionController.SendAjaxRequest(data, 'POST', 'json', url, success);
        }

    },
    verifyNameFields: function(str) {
        if (/[a-z]/i.test(str)) {
            if (str.length > 1)
                return true;
        }
        return false;
    },
    verifyLinkFields: function(str) {
        return true;

        if (str.length > 5)
            return true;

        return false;
    },
    verifyTextDescriptionFields: function(str) {
        if (str.length > 5)
            return true;

        return false;
    },
    updateUserEditProfileFieldsIOnLoad: function(data) {
        console.log(data);

        var field = document.getElementById('first_name');
        if (field) {
            field.value = data.first_name;
        }
        field = document.getElementById('last_name');
        if (field) {
            field.value = data.last_name;
        }
        field = document.getElementById('email');
        if (field) {
            field.value = data.email;
        }
        field = document.getElementById('country');
        if (field) {
            field.value = data.country;
        }

        field = document.getElementById('facebook_link');
        if (field) {
            field.value = data.facebook_link;
        }
        field = document.getElementById('facebook_visit_link');
        if (field) {
            field.href = data.facebook_link;
        }

        field = document.getElementById('website_link');
        if (field) {
            if (data.website_link)
                field.value = data.website_link;
        }

        field = document.getElementById('about_me');
        if (field) {
            if (data.about_me)
                field.value = data.about_me;
        }



    },
    updateUserProfilePageData: function(data) {
        this.current_profile_user = data;
        var user_profilepage_image = document.getElementById('user_profilepage_image');
        if (user_profilepage_image)
            user_profilepage_image.src = data.picture;

        var user_profilepage_name = document.getElementById('user_profilepage_name');
        if (user_profilepage_name)
            user_profilepage_name.innerHTML = data.name;

        var user_profilepage_points = document.getElementById('user_profilepage_points');
        if (user_profilepage_points)
            user_profilepage_points.innerHTML = data.total_points;

//        var user_profilepage_globalranking=document.getElementById('user_profilepage_globalranking');
//        if (user_profilepage_globalranking)
//            user_profilepage_globalranking.innerHTML = data.total_points;
    },
    createUserProfile: function(data) {

        var fb_login_button = document.getElementById('fb_login_button');
        if (fb_login_button)
            fb_login_button.style.display = 'none';

        var user_profile = document.getElementById('user_profile');
        if (user_profile)
            user_profile.style.display = 'block';

        var user_profile_picture = document.getElementById('user_profile_picture');
        if (user_profile_picture)
            user_profile_picture.src = data.picture;

        var user_name = document.getElementById('user_name');
        if (user_name)
            user_name.innerHTML = data.name;

        this.updateTopMenuUserProfile(data);
        this.updateTopUserPoints(data.total_points, data.global_rank);

        if (!data.country_choosen) {
            MiscController.fillChooseCountryList();
            MiscController.showChooseCountryPopup();
        }
        else {
            this.user_country = data.country_choosen;
            UserController.updateDOMUserSelectedCountry();
        }
    },
    removeplay_login_btn: function() {
        var play_login_btn = document.getElementById('play_login_btn');
        if (play_login_btn)
            play_login_btn.parentNode.removeChild(play_login_btn);
    },
    updateTopMenuUserProfile: function(data) {
        var user_pic_topmenu = document.getElementById('user_pic_topmenu');
        if (user_pic_topmenu)
            user_pic_topmenu.src = data.picture;

        var user_name_topmenu = document.getElementById('user_name_topmenu');
        if (user_name_topmenu)
            user_name_topmenu.innerHTML = data.name;

        var points = 0;
        if (data.total_points)
            points = data.total_points;
        var rank = 0;
        if (data.global_rank)
            rank = data.global_rank;

        var user_point_topmenu = document.getElementById('user_point_topmenu');
        if (user_point_topmenu)
            user_point_topmenu.innerHTML = 'Points : ' + points;

        var user_ranking_topmenu = document.getElementById('user_ranking_topmenu');
        if (user_ranking_topmenu)
            user_ranking_topmenu.innerHTML = 'Global Ranking : ' + rank;

        var profile_page_url = document.getElementById('profile_page_url');
        if (profile_page_url)
            profile_page_url.href = window.baseurl + 'user/userprofile';
    },
    updateTopUserPoints: function(points, rank) {
        var user_point_topmenu = document.getElementById('user_point_topmenu');
        if (user_point_topmenu)
            user_point_topmenu.innerHTML = 'Points : ' + points;

        if (rank) {
            var user_ranking_topmenu = document.getElementById('user_ranking_topmenu');
            if (user_ranking_topmenu)
                user_ranking_topmenu.innerHTML = 'Global Ranking : ' + rank;
        }
    },
    updateDOMUserSelectedCountry: function(other_than_home) {
        var user_selected_country = document.getElementById('user_selected_country');
        if (user_selected_country)
            user_selected_country.innerHTML = '&nbsp;&nbsp; in ' + this.user_country;

        var image_start = '';
        if (other_than_home)
            image_start = '../../';

        var user_selected_country_img = document.getElementById('user_selected_country_img');
        if (user_selected_country_img)
            user_selected_country_img.src = image_start + 'assets/images/flags/' + this.user_country + '.png';
        
        var user_selected_country_link=document.getElementById('user_selected_country_link');
        if(user_selected_country_link)
            user_selected_country_link.href=window.baseurl+'ranking/countryranking?c='+this.user_country;
    },
    updateUserTimeLine: function(data) {
        var user_timeline = document.getElementById('user_timeline');

        var current_Time = new Date();
        var li;

        var show_more_timeline = document.getElementById('show_more_timeline');
        if (show_more_timeline)
            show_more_timeline.parentNode.removeChild(show_more_timeline);

        var show_more = document.createElement('button');
        show_more.className = 'btn btn-default';
        show_more.innerHTML = 'show more...';
        show_more.setAttribute('onclick', 'UserController.showmoreTimeline()');
        show_more.id = 'show_more_timeline';
        for (var row in data) {
            row = data[row];

            li = this.generatetimeLineLIByType(row, current_Time);
            if (li)
                user_timeline.appendChild(li);
        }

        user_timeline.appendChild(show_more);
    },
    createUserTimeLine: function(data) {
        var user_timeline = document.getElementById('user_timeline');
        var parentNode = user_timeline.parentNode;
        user_timeline.parentNode.removeChild(user_timeline);

        user_timeline = document.createElement('ul');
        user_timeline.className = 'cbp_tmtimeline';
        user_timeline.id = 'user_timeline';


        var current_Time = new Date();
        var li;
        var show_more = document.createElement('button');
        show_more.className = 'btn btn-default';
        show_more.innerHTML = 'show more...';
        show_more.id = 'show_more_timeline';
        show_more.setAttribute('onclick', 'UserController.showmoreTimeline()');
        for (var row in data) {
            row = data[row];

            li = this.generatetimeLineLIByType(row, current_Time);
            if (li)
                user_timeline.appendChild(li);
        }

        user_timeline.appendChild(show_more);
        parentNode.appendChild(user_timeline);
    },
    showmoreTimeline: function(current_activity_type_id) {
        if (current_activity_type_id)
            this.current_activity_type_id = current_activity_type_id;

        var activity_type_id = UserController.current_activity_type_id;
        var uid = UserController.uid;
        var limit = UserController.last_limit;
        UserController.last_offset += limit;
        var offset = UserController.last_offset;


        var success = function(data) {
            DataActionController.disableAjaxmask();
            UserController.updateUserTimeLine(data);
        };
        var url = 'user/profiletimeline';
        var data = {
            limit: limit,
            offset: offset,
            activity_type_id: activity_type_id,
            uid: uid
        };
        DataActionController.SendAjaxRequest(data, 'POST', 'json', url, success);

    },
    generatetimeLineLIByType: function(row, current_Time) {
        var li, time, i, div, span, record_time, date, diff_days, day_str, time_date;
        var h2, result, properties, game_class, description, div2;
        if (parseInt(row.activity_type_id) === 6) {//general type
            li = document.createElement('li');

            record_time = row.created_ts;
            date = new Date(record_time.split(' ').join('T'));
            diff_days = this.dateDifferenceInDays(date, current_Time);
            var min = date.getMinutes();
            if (min < 10)
                min = '0' + min;

            time_date = date.getHours() + ':' + min;


            if (diff_days > 1)
                day_str = diff_days + ' days ago';
            else {
                //diff_days=this.dateDifferenceInHours(date,current_Time);
                day_str = 'recently';
            }

            time = document.createElement('time');
            time.className = 'cbp_tmtime';
            span = document.createElement('span');
            span.innerHTML = time_date;
            time.appendChild(span);
            span = document.createElement('span');
            span.innerHTML = day_str;
            time.appendChild(span);
            li.appendChild(time);

            div = document.createElement('div');
            div.className = 'cbp_tmicon timeline-bg-gray';
            i = document.createElement('i');
            i.className = 'fa-user';
            div.appendChild(i);
            li.appendChild(div);

            div = document.createElement('div');
            div.className = 'cbp_tmlabel empty';
            span = document.createElement('span');
            span.innerHTML = row.description;
            div.appendChild(span);
            li.appendChild(div);

            return li;
        }
        else if (parseInt(row.activity_type_id) === 2) {//game type
            li = document.createElement('li');

            record_time = row.created_ts;
            date = new Date(record_time.split(' ').join('T'));
            diff_days = this.dateDifferenceInDays(date, current_Time);
            var min = date.getMinutes();
            if (min < 10)
                min = '0' + min;

            time_date = date.getHours() + ':' + min;


            if (diff_days > 1)
                day_str = diff_days + ' days ago';
            else {
                //diff_days=this.dateDifferenceInHours(date,current_Time);
                day_str = 'recently';
            }

            time = document.createElement('time');
            time.className = 'cbp_tmtime';
            span = document.createElement('span');
            span.innerHTML = time_date;
            time.appendChild(span);
            span = document.createElement('span');
            span.innerHTML = day_str;
            time.appendChild(span);
            li.appendChild(time);

            properties = row.json_properties;
            properties = JSON.parse(properties);
            if (properties.result) {
                result = '(Correct, Level 1: +' + properties.point + ' )';
                game_class = 'cbp_tmicon timeline-bg-success';
            } else {
                result = '(Wrong, Level 1: +' + properties.point + ' )';
                game_class = 'cbp_tmicon timeline-bg-red';
            }


            div = document.createElement('div');
            div.className = game_class;
            i = document.createElement('i');
            i.className = 'fa-gamepad';
            div.appendChild(i);
            li.appendChild(div);

            description = row.description;
            description = JSON.parse(description);
//            console.log(description);

            div = document.createElement('div');
            div.className = 'cbp_tmlabel';
            h2 = document.createElement('h2');
            span = document.createElement('span');
            span.innerHTML = this.current_profile_user.name;
            h2.appendChild(span);
            span = document.createElement('span');
            span.innerHTML = ' just played the following recipe <strong>' + result + '</strong>';
            h2.appendChild(span);
            div2 = document.createElement('div');
            div2.className = 'row';
            var div3 = document.createElement('div');
            div3.className = 'col-xs-3';
            var a = document.createElement('a');
            a.href = '#';
            var img = document.createElement('img');
            img.src = '../../' + description.image_link;
            img.className = 'img-responsive img-rounded full-width';
            a.appendChild(img);
            div3.appendChild(a);
            div2.appendChild(div3);
            div3 = document.createElement('div');
            div3.className = 'col-xs-9';
            var strong = document.createElement('strong');
            strong.innerHTML = description.name;
            div3.appendChild(strong);
            var p = document.createElement('p');
            p.innerHTML = description.description;
            div3.appendChild(p);
            div2.appendChild(div3);


            div.appendChild(h2);
            div.appendChild(div2);
            li.appendChild(div);

            return li;
        }
    },
    dateDifferenceInDays: function(a, b) {
        var _MS_PER_DAY = 1000 * 60 * 60 * 24;
        // Discard the time and time-zone information.
        var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
        var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

        return Math.floor((utc2 - utc1) / _MS_PER_DAY);
    },
    dateDifferenceInHours: function(a, b) {
        var _MS_PER_DAY = 1000 * 60 * 60;
        // Discard the time and time-zone information.
        var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
        var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

        var value = Math.floor((utc2 - utc1) / _MS_PER_DAY);
        console.log(value);
        return value;
    },
    dispplayRanking: function(ranking_data,current_user) {
        
        var ranking_rows = document.getElementById('ranking_rows');
        var tr,td,img,a;
        if (ranking_rows){        
            var pnode=ranking_rows.parentNode;
            pnode.removeChild(ranking_rows);
            
            ranking_rows=document.createElement('tbody');
            ranking_rows.id='ranking_rows';
            pnode.appendChild(ranking_rows);
            
        var i=0,user_ranking=false;
            for(var row in ranking_data){
                user_ranking=false;
                row=ranking_data[row];
                i++;
                tr=document.createElement('tr');
                if(i===1)
                    tr.id='row_1';
                if(current_user){
                    if(current_user===row.user_id){
                        tr.className='YouRanking';
                        user_ranking=true;
                    }
                }
                
                td=document.createElement('td');
                td.className='middle-align';
                td.innerHTML=row.rank;
                tr.appendChild(td);
                
                td=document.createElement('td');
                td.className='middle-align';
                td.setAttribute('width','5%');
                img=document.createElement('img');
                img.src='../../assets/images/flags/'+row.country+'.png';
                img.setAttribute('width','18');
                td.appendChild(img);
                tr.appendChild(td);
                
                td=document.createElement('td');
                td.className='middle-align';                
                img=document.createElement('img');
                img.src=row.picture;
                img.setAttribute('width','28');
                img.className='img-circle img-inline userpic-32';
                td.appendChild(img);
                a=document.createElement('a');
                a.innerHTML=row.first_name+' '+row.last_name;
                a.href=window.baseurl+'user/userprofile?u_id='+row.user_id;
                td.appendChild(a);
                tr.appendChild(td);
                
                td=document.createElement('td');
                td.className='middle-align PointsCount';
                td.innerHTML=row.points;
                tr.appendChild(td);
                
                
                var total_q=parseInt(row.question_right)+parseInt(row.question_wrong);
                var percentage=(parseInt(row.question_right)*100)/total_q;
                percentage=Math.round(percentage);
                
                td=document.createElement('td');
                td.className='middle-align';
                td.innerHTML=percentage;
                tr.appendChild(td);
                
                td=document.createElement('td');
                td.className='middle-align';
                td.innerHTML=total_q;
                tr.appendChild(td);
                
                 td=document.createElement('td');
                td.className='middle-align';
                td.innerHTML=row.question_right;
                tr.appendChild(td);
                
                td=document.createElement('td');
                td.className='middle-align';
                td.innerHTML=row.question_wrong;
                tr.appendChild(td);
                
                if(i!==1 && user_ranking){
                    var firstchild=document.getElementById('row_1');
                    if(firstchild)
                        firstchild.parentNode.insertBefore(tr,firstchild);
                    
                    var tmp_tr=tr.cloneNode(true);
                    tr=tmp_tr;
                }
                
                    ranking_rows.appendChild(tr);
            }
        }
    }
};
window.UserController = UserController;
