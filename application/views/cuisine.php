<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Xenon Boostrap Admin Panel" />
        <meta name="author" content="" />

        <title>Cuisine Detail</title>

        <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900|Lato:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/fonts/linecons/css/linecons.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/fonts/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/bootstrap-social.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-core.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-forms.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-components.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-skins.css">

        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/custom.css?v=1">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/rehan_custom.css?v=1">

        <script src="<?php echo ROOT_URL ?>assets/js/jquery-2.0.3.min.js"></script>

<!--	<script src="<?php echo ROOT_URL ?>assets/js/jquery-1.11.1.min.js"></script>-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="page-body right-sidebar boxed-container">
        
        <script>
       
    (function(d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));    
        </script>

        <div id="ajax_loader" >
            <img src="<?php echo ROOT_URL ?>assets/images/icons/gif-load.GIF" alt="ajax loader"/>
        </div>
        <div id="ajaxOverlay">                
        </div>

        <div class="settings-pane">

            <a href="#" data-toggle="settings-pane" data-animate="true">
                &times;
            </a>

            <div class="settings-pane-inner">

                <div class="row">

                    <div class="col-md-4">

                        <div class="user-info">

                            <div class="user-image">
                                <a href="#">
                                    <img id="user_pic_topmenu" src="<?php echo ROOT_URL ?>assets/images/user-2.png" class="img-responsive img-circle" />
                                </a>
                            </div>

                            <div class="user-details">

                                <h3>
                                    <a href="#" id="user_name_topmenu"></a>

                                    <!-- Available statuses: is-online, is-idle, is-busy and is-offline -->
                                    <span class="user-status is-online"></span>
                                </h3>

                                <p class="user-title" id="user_point_topmenu"></p>
                                <p class="user-title" id="user_ranking_topmenu"></p>

                                <div class="user-links">
                                    <a id='profile_page_url' href="" class="btn btn-primary"><i class="linecons-cog"></i> Profile</a>
                                    <br/>
                                    <a href="#" class="btn btn-primary" onclick="DataActionController.dataaction('logout')"><i class="linecons-lock"></i> Logout</a>
                                </div>                                                        

                            </div>

                        </div>

                    </div>

                    <div class="col-md-8 link-blocks-env">




                    </div>

                </div>

            </div>

        </div>

        <nav class="navbar navbar-fixed-top horizontal-menu"><!-- set fixed position by adding class "navbar-fixed-top" -->

            <div class="navbar-inner">

                <!-- Navbar Brand -->
                <div class="navbar-brand">

                    <a href="<?php echo ROOT_URL; ?>" >
                        <span class="logo1">Guess Food</span>				
                    </a>


                </div>

                <!-- Mobile Toggles Links -->
                <div class="nav navbar-mobile">

                    <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                    <div class="mobile-menu-toggle">
                        <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
                        <a href="#" data-toggle="settings-pane" data-animate="true">
                            <i class="linecons-cog"></i>
                        </a>

                        <a href="#" data-toggle="user-info-menu-horizontal">
                            <i class="fa-bell-o"></i>

                        </a>

                        <!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
                        <!-- data-toggle="mobile-menu" will show sidebar menu links only -->
                        <!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
                        <a href="#" data-toggle="mobile-menu-horizontal">
                            <i class="fa-bars"></i>
                        </a>
                    </div>

                </div>

                <div class="navbar-mobile-clear"></div>



                <!-- main menu -->

                <ul class="navbar-nav">
                     <li class="navbarPlay">
                        <a href="<?php echo ROOT_URL; ?>">
                            <i class="fa-gamepad"></i>
                            <span class="title">Play!</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ROOT_URL.'ranking/globalranking'; ?>">
                            <i class="linecons-globe"></i>
                            <span class="title">Global Ranking</span>
                        </a>
                        <ul>
                            <li>

                                <a>
                                    <span class="title"><h4><i class="fa-flag"></i> Country Rankings</h4></span></a>
                            </li>
                            <li>
                                <a id="user_selected_country_link" href="<?php echo ROOT_URL.'ranking/countryranking?c=Spain'; ?>">
								<img width="18" id="user_selected_country_img" src="assets/images/flags/Spain.png"/>
								<span class="title" id="user_selected_country">in Spain</span>
							</a>
                            </li>
                            <li>
                                <a href="layout-variants.html">
                                    <span class="title"><strong>All the countries:</strong></span>
                                </a>
                            </li>


                            <div id="dropdown_menu_country_list" class="scrollable scroll" data-max-height="250" style="max-height: 250px;">


                            </div>
                        </ul>



                    </li>

                    <li ><!-- class="opened active" -->
                        <a href="#">
                            <i class="linecons-food"></i><span class="title">Cuisine Rankings</span>
                        </a>
                        <ul id="cuisine_list_topmenu">

                        </ul>
                    </li>
                    <li>
                        <a href=#">
                            <i class="linecons-search"></i><span class="title">Recipe Database</span>
                        </a>

                    </li>

                </ul>


                <!-- notifications and other links -->
                <ul class="nav nav-userinfo navbar-right">


                    <li class="dropdown user-profile">
                        <a href="#" data-toggle="settings-pane" style="display: none" id="user_profile">
                            <img id="user_profile_picture" src="<?php echo ROOT_URL ?>assets/images/user-1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                            <span>
                                <span id="user_name">---</span>
                                <i class="fa-angle-up"></i>
                            </span>
                        </a>

                        <span id="fb_login_button" style="display: none">
                            <a class="btn btn-block btn-social btn-lg btn-facebook" onclick="DataActionController.dataaction('login-facebook')">
                                <i class="fa fa-facebook"></i> Sign in with Facebook
                            </a>
                        </span>

                        <?php if ($loggedIn) { ?>
                            <script>
                                var user_profile = document.getElementById('user_profile');
                                user_profile.style.display = 'block';

                                var user_name = document.getElementById('user_name');
                                user_name.innerHTML = '<?php echo $name ?>';

                                var user_profile_picture = document.getElementById('user_profile_picture');
                                user_profile_picture.src = '<?php echo $picture ?>';

                            </script>
                        <?php } else { ?>
                            <script>
                                var fb_login_button = document.getElementById('fb_login_button');
                                fb_login_button.style.display = 'block';
                            </script>

                        <?php } ?>					

                    </li>


                </ul>

            </div>

        </nav>


        <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

            <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
            <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
            <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
            <div class="sidebar-menu toggle-others">
                <div id="right_col_Adz">                        
                </div>
                <div class="sidebar-menu-inner" id="right_col_without_Adz">	
                    <div class="SidebarJumbo">	
                        <h1>The community to learn about World Food</h1>
                        <h4>Become a world foodie by playing</h4>
                        <?php if (!$loggedIn) { ?>
                            <button id="play_login_btn" type="button" class="btn btn-blue btn-icon-standalone btn-block btn-lg" onclick="DataActionController.dataaction('login-facebook')">
                                <i class="fa-facebook"></i>
                                <span >Sign in & play</span>
                            </button>
                        <?php } ?>
                    </div>

                    <div class="SidebarJumboTeach">	
                        <h3>What are the main dishes of your country?</h3>
                        <h5>Share your knowledge and contribute</h5>
                        <button type="button" class="btn btn-secondary btn-icon-standalone ">
                            <i class="linecons-megaphone"></i>
                            <span>Teach us!</span>
                        </button>
                    </div>

                </div>

            </div>

            <div class="main-content">


                <div class="row" id="main_ranking_parent">
                    	
                    <h1 style="margin-left:10px; display:inline-block;  vertical-align: text-bottom;"><?php print_r ($cuisine->name); ?></h1>
                        <br/>
                        <?php print_r ($cuisine->description); ?>
                        <br/><br/>
                      
                     <table class="table table-condensed table-hover">
							<thead>
								<tr >
									
									<th>#</th>
									<th>Name</th>
									<th>Facebook Share count</th>
									<th>Facebook Like count</th>
									<th>Action</th>									
								</tr>
							</thead>
							
							<tbody id="ranking_rows">
							   <?php
                                                          
                                                          $counter=1;
                                                           foreach($recipies as $recipie){
                                                               $url=ROOT_URL.'recipie/view/';
                                                               $url.=$this->question_answer_model->makeUrlFromTitle($recipie->name);
                                                               $fb_detail=$this->facebook_model->getLinkFacebookdetail_fqlquery($url);
                                                                 ?>
                                                            <tr>
                                                                <td><?php echo $counter++; ?></td>
                                                                <td><?php echo $recipie->name; ?></td>
                                                                <td><?php echo $fb_detail->share_count; ?></td>
                                                                <td><?php echo $fb_detail->like_count; ?></td>
                                                                <td><a href="<?php echo $url; ?>" target="blank">View</a></td>
                                                            </tr>
                                                            <?php
                                                           }
                                                           ?>
							</tbody>
						</table>
                        
                        <div id="pagination_block">
                            
                        </div>  
                        
                        
                </div>



            </div>



        </div>
        <!-- Main Footer -->
        <!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
        <!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
        <!-- Or class "fixed" to  always fix the footer to the end of page -->
        <footer class="main-footer sticky footer-type-1">

            <div class="footer-inner">

                <!-- Add your copyright text here -->
                <div class="footer-text">
                    &copy; 2014 
                    <strong>Xenon</strong> 
                    theme by <a href="http://laborator.co" target="_blank">Laborator</a>
                </div>


                <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                <div class="go-up">

                    <a href="#" rel="go-top">
                        <i class="fa-angle-up"></i>
                    </a>

                </div>

            </div>

        </footer>
    </div>


    <!-- start: Modal Section -->
    <div class="modal fade" id="rules">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Rules and Points</h4>
                </div>

                <div class="modal-body">
                    The Rules of the Game
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-info">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="chooseCountry">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Choose your Country</h4>
                </div>

                <div class="modal-body">
                    <select id="country_list" name="country" size="1">

                    </select>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-info" onclick="DataActionController.dataaction('usercountry')">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Chat Section -->


</div>



<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/js/select2/select2.css">
<link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/js/multiselect/css/multi-select.css">


<!-- Bottom Scripts -->
<script src="<?php echo ROOT_URL ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/TweenMax.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/resizeable.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/joinable.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/xenon-api.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/xenon-toggles.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/moment.min.js"></script>

<!-- My Own Scripts -->
<script src="<?php echo ROOT_URL ?>assets/js/guessfood/facebook_settings.js?v=1"></script>
<script src="<?php echo ROOT_URL ?>assets/js/guessfood/UserController.js?v=1"></script>
<script src="<?php echo ROOT_URL ?>assets/js/guessfood/MiscController.js?v=1"></script>
<script src="<?php echo ROOT_URL ?>assets/js/guessfood/QuestionAnswerController.js?v=1"></script>
<script src="<?php echo ROOT_URL ?>assets/js/guessfood/DataActionController.js?v=1"></script>

<!-- Imported scripts on this page -->
<script src="<?php echo ROOT_URL ?>assets/js/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/select2/select2.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/typeahead.bundle.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/handlebars.min.js"></script>
<script src="<?php echo ROOT_URL ?>assets/js/multiselect/js/jquery.multi-select.js"></script>



<!-- JavaScripts initializations and stuff -->
<script src="<?php echo ROOT_URL ?>assets/js/xenon-custom.js"></script>

<script>
                                DataActionController.setBaseUrl('<?php echo ROOT_URL; ?>');
</script>

<?php if ($loggedIn) { ?>
    <script>
        var name = '<?php echo $name; ?>';
        var picture = '<?php echo $picture; ?>';
        UserController.updateTopMenuUserProfile({name: name, picture: picture});
        UserController.user_loggedIn = true;
    </script>
<?php } ?>

<?php if (isset($total_points)) { ?>
    <script>
        UserController.updateTopUserPoints('<?php echo $total_points; ?>', '<?php echo $global_rank; ?>');
    </script>
<?php } ?>

<?php if (!$country_choosen && $loggedIn) { ?>
    <script>
        MiscController.fillChooseCountryList();
        MiscController.showChooseCountryPopup();
    </script>
<?php } else if ($loggedIn) { ?>
    <script>

        UserController.user_country = '<?php echo $country_choosen; ?>';
        UserController.updateDOMUserSelectedCountry(true);
    </script>
<?php } ?>

        
<script>


   // MiscController.populateDrownDownMenu(true);
    MiscController.populateCuisines();    
   // QuestionAnswerController.displayAdz(true);
    
     FacebookController.initialize();

</script>
 <?php
       $this->load->helper('footerscript_helper');       
       ?>
</body>
</html>