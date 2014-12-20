<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Xenon Boostrap Admin Panel" />
        <meta name="author" content="" />

        <title>Xenon - Boxed &amp; Horizontal Menu</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/fonts/linecons/css/linecons.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/fonts/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/bootstrap-social.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-core.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-forms.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-components.css">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/xenon-skins.css">

        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/custom.css?v=2">
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>assets/css/rehan_custom.css?v=2">


        <script src="<?php echo ROOT_URL ?>assets/js/jquery-1.11.1.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="page-body boxed-container">
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
								<!--<a href="#" class="btn btn-primary"><i class="linecons-cog"></i> Edit Profile</a>-->
                                        <!--<br/>-->
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

                    <a href="#" data-toggle="settings-pane" data-animate="true">
                        <i class="linecons-cog"></i>
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
                            <span class="badge badge-success">7</span>
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
                        <a href="#" data-toggle="settings-pane" id="user_profile" style="display: none">
                            <img id="user_profile_picture" src="assets/images/user-1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
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
                                var user_obj =<?php echo $loggedin_user_detail ?>;
                                var user_profile = document.getElementById('user_profile');
                                user_profile.style.display = 'block';

                                var user_name = document.getElementById('user_name');
                                user_name.innerHTML = user_obj.name;

                                var user_profile_picture = document.getElementById('user_profile_picture');
                                user_profile_picture.src = user_obj.picture;

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



        <div class="page-container "><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

            <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
            <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
            <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->


            <div class="main-content">

                <script>
                    jQuery(document).ready(function($)
                    {
                        $('a[href="#layout-variants"]').on('click', function(ev)
                        {
                            ev.preventDefault();

                            var win = {top: $(window).scrollTop(), toTop: $("#layout-variants").offset().top - 15};

                            TweenLite.to(win, .3, {top: win.toTop, roundProps: ["top"], ease: Sine.easeInOut, onUpdate: function()
                                {
                                    $(window).scrollTop(win.top);
                                }
                            });
                        });
                    });
                </script>


                <section class="profile-env">

                    <div class="row">

                        <div class="col-sm-3">


                            <!-- User Info Sidebar -->
                            <div class="user-info-sidebar">

                                <a href="#" class="user-img">
                                    <img id="user_profilepage_image" src="<?php echo ROOT_URL ?>assets/images/user-4.png" alt="user-img" class="img-cirlce img-responsive img-thumbnail" />
                                </a>

                                <a href="#" class="user-name">
                                    <span id="user_profilepage_name"></span>
                                    <span class="user-status is-online"></span>
                                </a>



                                <div class="wrapper">
                                    <a href="<?php echo ROOT_URL.'user/editprofile'; ?>" ><i class="linecons-cog"></i> Edit Profile</a>	
                                </div>

                                <hr />


                                <ul class="list-unstyled user-friends-count">
                                    <li>
                                        <span id="user_profilepage_points">-</span>
                                        Points
                                    </li>
                                    <li>
                                        <span id="user_profilepage_globalranking">-</span>
                                        Global Ranking
                                    </li>
                                </ul>
                                <div class="scrollable ps-container ps-active-y" data-max-height="250" style="max-height: 250px;">


                                </div>
                                <hr />


                                <hr />




                            </div>

                        </div>

                        <div class="col-sm-9">


                            <div id="activity_buttons">

                            </div>


                            <!-- User timeline stories -->
                            <section class="user-timeline-stories">
                                <ul class="cbp_tmtimeline" id="user_timeline">
                                    
                                </ul>
                            </section>

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

        </div>






        <!-- Bottom Scripts -->
        <script src="<?php echo ROOT_URL ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo ROOT_URL ?>assets/js/TweenMax.min.js"></script>
        <script src="<?php echo ROOT_URL ?>assets/js/resizeable.js"></script>
        <script src="<?php echo ROOT_URL ?>assets/js/joinable.js"></script>
        <script src="<?php echo ROOT_URL ?>assets/js/xenon-api.js"></script>
        <script src="<?php echo ROOT_URL ?>assets/js/xenon-toggles.js"></script>

        <!-- My Own Scripts -->
        <script src="<?php echo ROOT_URL ?>assets/js/guessfood/facebook_settings.js?v=2"></script>
        <script src="<?php echo ROOT_URL ?>assets/js/guessfood/UserController.js?v=2"></script>
        <script src="<?php echo ROOT_URL ?>assets/js/guessfood/MiscController.js?v=2"></script>        
        <script src="<?php echo ROOT_URL ?>assets/js/guessfood/DataActionController.js?v=2"></script>

        <!-- JavaScripts initializations and stuff -->
        <script src="<?php echo ROOT_URL ?>assets/js/xenon-custom.js"></script>


        <script>
            DataActionController.setBaseUrl('<?php echo ROOT_URL; ?>');
                                UserController.updateUserProfilePageData(<?php echo $user_detail; ?>);
        </script>

        <?php if ($loggedIn) { ?>
            <script>
                var user_obj =<?php echo $loggedin_user_detail ?>;

                UserController.updateTopMenuUserProfile(user_obj);
                UserController.user_loggedIn = true;
            </script>
        <?php } ?>

        <?php if (isset($total_points)) { ?>
            <script>
                UserController.updateTopUserPoints('<?php echo $total_points; ?>');
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
            

            MiscController.populateDrownDownMenu(true);
            MiscController.populateCuisines();
            var obj=<?php echo $user_detail; ?>;
            DataActionController.fetchUserTimeLine(10,0,null,obj.uid);
            
            obj=<?php echo $activity_types; ?>;
            MiscController.createActivityTypeButtons(obj);

            FacebookController.initialize();
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
         <?php
       $this->load->helper('footerscript_helper');       
       ?>
    </body>
</html>