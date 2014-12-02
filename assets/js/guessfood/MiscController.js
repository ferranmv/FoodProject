/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var MiscController={
    image_start:'',
    final_country_array:['Afghanistan','Albania','Algeria','American Samoa','Andorra','Angola','Anguilla','Antarctica','Antigua and Barbuda','Argentina','Armenia','Aruba','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Bouvet Island','Brazil','British Indian Ocean territory','Brunei Darussalam','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Cape Verde','Cayman Islands','Central African Republic','Chad','Chile','China','Christmas Island','Cocos (Keeling) Islands','Colombia','Comoros','Congo','Congo, Democratic Republic','Cook Islands','Costa Rica','CÃ´te d Ivoire (Ivory Coast)','Croatia (Hrvatska)','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','East Timor','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Falkland Islands','Faroe Islands','Fiji','Finland','France','French Guiana','French Polynesia','French Southern Territories','Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guadeloupe','Guam','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Heard and McDonald Islands','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Korea (north)','Korea (south)','Kuwait','Kyrgyzstan','Lao Peoples Democratic Republic','Latvia','Lebanon','Lesotho','Liberia','Libyan Arab Jamahiriya','Liechtenstein','Lithuania','Luxembourg','Macao','Macedonia, Former Yugoslav Republic Of','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Martinique','Mauritania','Mauritius','Mayotte','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','Netherlands Antilles','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Niue','Norfolk Island','Northern Mariana Islands','Norway','Oman','Pakistan','Palau','Palestinian Territories','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Pitcairn','Poland','Portugal','Puerto Rico','Qatar','RÃ©union','Romania','Russian Federation','Rwanda','Saint Helena','Saint Kitts and Nevis','Saint Lucia','Saint Pierre and Miquelon','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Georgia and the South Sandwich Islands','Spain','Sri Lanka','Sudan','Suriname','Svalbard and Jan Mayen Islands','Swaziland','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Tokelau','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Turks and Caicos Islands','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States of America','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Virgin Islands (British)','Virgin Islands (US)','Wallis and Futuna Islands','Western Sahara','Yemen','Zaire','Zambia','Zimbabwe'],
    populateDrownDownMenu:function(other_then_home){
        this.image_start='';
        if(other_then_home)
            this.image_start='../../';
      
        var dropdown_menu_country_list=document.getElementById('dropdown_menu_country_list');
        var li,a,img,span,i=0;
        for(var country in this.final_country_array){
            i++;
            
            li=document.createElement('li');
            a=document.createElement('a');
            a.href=window.baseurl+'ranking/countryranking?c='+this.final_country_array[country];
            
            img=document.createElement('img');
            img.id='country_'+i;
            img.src=this.image_start+'assets/images/flags/'+this.final_country_array[country]+'.png';
            img.setAttribute('width','18');
            img.setAttribute('onError','MiscController.showCountryDefaultImage('+img.id+')');
            a.appendChild(img);
            
            span=document.createElement('span');
            span.className='title';
            span.innerHTML='&nbsp;&nbsp;'+this.final_country_array[country];
            a.appendChild(span);
            
            li.appendChild(a);
            dropdown_menu_country_list.appendChild(li);
        }
         
    },
    showCountryDefaultImage:function(img){
        img.src=MiscController.image_start+'assets/images/flags/World.png';
    },
    fillChooseCountryList:function(){
        var country_list=document.getElementById('country_list');
        var option;
        
         for(var country in this.final_country_array){
            option=document.createElement('option');
            option.value=this.final_country_array[country];
            option.innerHTML=this.final_country_array[country];
            
            country_list.appendChild(option);
         }
    },
    showChooseCountryPopup:function(){
        $('#chooseCountry').modal('show', {backdrop: 'fade'});
    },
    destroyChooseCountryPopup:function(){
        $('#chooseCountry').modal('hide');
    },
    populateCuisines:function(){
       
        var success = function(data) {
                DataActionController.disableAjaxmask();
                 MiscController.cuisines=data;
                 var cuisine_list_topmenu=document.getElementById('cuisine_list_topmenu');
                 var li,a,img,span;
                 for(var cuisine in MiscController.cuisines){
                     cuisine=MiscController.cuisines[cuisine];
                     li=document.createElement('li');
                     a=document.createElement('a');
                     a.href=window.baseurl+'ranking/cuisineranking?c_id='+cuisine.cuisine_id;
                     img=document.createElement('img');
                     img.setAttribute('width','18');
                     img.src=MiscController.image_start+'assets/images/flags/'+cuisine.flag+'.png';
                     a.appendChild(img);
                     span=document.createElement('span');
                     span.innerHTML='&nbsp;&nbsp;'+cuisine.name;
                     a.appendChild(span);
                     
                     li.appendChild(a);
                     cuisine_list_topmenu.appendChild(li);
                 }
        
            };
            var url = 'cuisine/getallcuisines'
            var data = {};
            DataActionController.SendAjaxRequest(data, 'POST', 'json', url, success);
    },
    getActivityClassNames:function(id){
        switch(id){
            case 1:
                return 'bookmark';
                case 2:
                return 'gamepad';
                case 3:
                return 'trophy';
                case 4:
                return 'star';
                case 5:
                return 'child';
                case 6:
                return 'star';
        }
    },
    ActivityButtonClicked:function(button){
        var id=button.id.split('_')[1];
        
        DataActionController.fetchUserTimeLine(10,0,id,UserController.uid);
    },
    createActivityTypeButtons:function(data){
        var activity_buttons=document.getElementById('activity_buttons');
        if(!activity_buttons)
            return;
        
        var button,i,classname,span;
        for(var row in data){
            row=data[row];
            classname=this.getActivityClassNames(row.activity_type_id);
            
            button=document.createElement('button');
            button.id='activity_'+row.activity_type_id;
            button.className='btn btn-white btn-lg';
            button.setAttribute('onclick','MiscController.ActivityButtonClicked('+button.id+')');
            
            i=document.createElement('i');
            i.className='fa-'+classname;
            button.appendChild(i);
            
            span=document.createElement('span');
            span.innerHTML=row.name;
            button.appendChild(span);
            
            activity_buttons.appendChild(button);
        }
    },
    paginationRankingAjaxRequest:function(page){
        console.log(page);
        this.displayPageRanking(page,MiscController.rankingType);
    },
    createPagination: function(totalpages) {
        if(!totalpages)
            totalpages=MiscController.rankngTotalPages;
        
        var currentPage = this.CurrentPage;
        var allDesigns = document.getElementById('pagination_block');
        var paginationParent = document.getElementById('pagination_parent');
        if (paginationParent)
            paginationParent.parentNode.removeChild(paginationParent);

        paginationParent = document.createElement('div');
        paginationParent.id = 'pagination_parent';

        var span;
        var max_page_to_show = 5;
        if (totalpages <= max_page_to_show) {
            for (var i = 1; i <= totalpages; i++) {
                span = document.createElement('span');
                span.className = 'pages';
                span.innerHTML = i;
                span.setAttribute('onclick','MiscController.paginationRankingAjaxRequest('+i+')');
//                span.setAttribute('data-action', 'galleryPage-' + baseurl + 'gallery.php?p=' + i);
                if (i === currentPage)
                    span.className = 'activePage';
                paginationParent.appendChild(span);
            }
        }
        else {
            var i = 1;
            span = document.createElement('span');
            span.className = 'pages';
            span.innerHTML = i;
            span.setAttribute('onclick','MiscController.paginationRankingAjaxRequest('+i+')');
//            span.setAttribute('data-action', 'galleryPage-' + baseurl + 'gallery.php?p=' + i);
            if (i === currentPage)
                span.className = 'activePage';
            paginationParent.appendChild(span);

            var range = 5;
            var start = currentPage - range;
            if (start < 2)
                start = 2;
            var end = currentPage + range;
            if (end > totalpages)
                end = totalpages;

            for (i = start; i <= end; i++) {
                span = document.createElement('span');
                span.className = 'pages';
                span.innerHTML = i;
                span.setAttribute('onclick','MiscController.paginationRankingAjaxRequest('+i+')');
//                span.setAttribute('data-action', 'galleryPage-' + baseurl + 'gallery.php?p=' + i);
                if (i === currentPage)
                    span.className = 'activePage';
                paginationParent.appendChild(span);
            }

            if (end < totalpages) {
                i = totalpages;
                span = document.createElement('span');
                span.className = 'pages';
                span.innerHTML = i;
                span.setAttribute('onclick','MiscController.paginationRankingAjaxRequest('+i+')');
//                span.setAttribute('data-action', 'galleryPage-' + baseurl + 'gallery.php?p=' + i);
                if (i === currentPage)
                    span.className = 'activePage';
                paginationParent.appendChild(span);
            }
        }


        allDesigns.appendChild(paginationParent);
    },
      displayPageRanking: function(page,type) {
        var max_per_page = 20;
        if (!page) {
            page = 1;
        }
        this.CurrentPage = page;
        var end = max_per_page * page;
        var start = end - max_per_page;
        end = max_per_page;

        var success = function(data) {
            DataActionController.disableAjaxmask();
            UserController.dispplayRanking(data,MiscController.c_u);
        };
        var country=null;
        if(type!=='global'){
            type=type.split('_');
            if(type[0]==='cuisine')
            {
                country=null;
                type=type[0];
            }
            else
            country=type[0];
        }
        
        var url = 'ranking/getranking';
        var data = {            
            offset: start,
            limit: end,
            ranking_type:type,
            country:country,
            cuisine_id:MiscController.current_cusine_id
        };
        DataActionController.SendAjaxRequest(data, 'POST', 'json', url, success);
    }
};
window.MiscController=MiscController;
