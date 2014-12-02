<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title>Guess Food - Learn all about world food by playing!</title>

	<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900|Lato:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="../../assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../../assets/css/xenon-core.css">
	<link rel="stylesheet" href="../../assets/css/xenon-forms.css">
	<link rel="stylesheet" href="../../assets/css/xenon-components.css">
	<link rel="stylesheet" href="../../assets/css/xenon-skins.css">
	<link rel="stylesheet" href="../../assets/css/custom.css">

	<script src="../../assets/js/jquery-1.11.1.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
</head>
<body class="page-body right-sidebar boxed-container">




	<div class="settings-pane">
			
		<a href="#" data-toggle="settings-pane" data-animate="true">
			&times;
		</a>
		
		<div class="settings-pane-inner">
			
			<div class="row">
				
				<div class="col-md-4">
					
					<div class="user-info">
						
						<div class="user-image">
							<a href="GuessFood-Profile.html">
								<img src="../../assets/images/user-2.png" class="img-responsive img-circle" />
							</a>
						</div>
						
						<div class="user-details">
							
							<h3>
								<a href="GuessFood-Profile.html">John Smith</a>
								
								<!-- Available statuses: is-online, is-idle, is-busy and is-offline -->
								<span class="user-status is-online"></span>
							</h3>
							
							<p class="user-title">643 points</p>
							<p class="user-title">12.035 Global Ranking</p>
							
							<div class="user-links">
								<a href="GuessFood-EditProfile.html" class="btn btn-primary"><i class="linecons-cog"></i> Edit Profile</a>
							</div>
							
						</div>
						
					</div>
					
				</div>
				
				<div class="col-md-4">
					<p class="user-title">Questions taken: 100</p>
					<p class="user-title">% Correct: 98%</p>
					<p class="user-title">Correct: 98</p>
					<p class="user-title">Correct: 2</p>
					<p class="user-title">Number of Badges: 5</p>	
				</div>
				
				
			</div>
		
		</div>
		
	</div>
	
	<nav class="navbar navbar-fixed-top horizontal-menu"><!-- set fixed position by adding class "navbar-fixed-top" -->
		
		<div class="navbar-inner">
		
			<!-- Navbar Brand -->
			<div class="navbar-brand">

				<a href="GuessFood.html" >
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
					<a href="GuessFood.html">
						<i class="fa-gamepad"></i>
						<span class="title">Play!</span>
					</a>
				</li>
				<li>
					<a href="GuessFood.html">
						<i class="linecons-globe"></i>
						<span class="title">Global Ranking</span>
					</a>
					<ul>
						<li>
							
								<a>
								<span class="title"><h4><i class="fa-flag"></i> Country Rankings</h4></span></a>
						</li>
						<li>
							<a href="layout-variants.html">
								<img width="18" src="../../assets/images/flags/Spain.png"/>
								<span class="title">in Spain</span>
							</a>
						</li>
						<li>
								<a href="layout-variants.html">
									<span class="title"><strong>All the countries:</strong></span>
								</a>
						</li>
						

						<div class="scrollable scroll" data-max-height="250" style="max-height: 250px;">
							
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>

							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
							<li>
								<a href="layout-variants.html">
									<img width="18" src="../../assets/images/flags/Spain.png"/>
									<span class="title">Spain Ranking</span>
								</a>
							</li>
						</div>
					</ul>
					


				</li>

					<li class="opened active">
					<a href="layout-variants.html">
						<i class="linecons-food"></i><span class="title">Cuisine Rankings</span>
					</a>
					<ul>
							<li>
								<a href="#">
									<img src="../../assets/images/flags/China.png" width="18"> Chinese Food
								</a>
							</li>
							
							<li>
								<a href="#">
									<img src="../../assets/images/flags/Italy.png" width="18"> Italian Food
								</a>
							</li>
							<li>
								<a href="#">
								<img src="../../assets/images/flags/India.png" width="18"> Indian Food
								</a> 
							</li>
							
							<li>
								<a href="#">
								<img src="../../assets/images/flags/Spain.png" width="18"> Spanish Food
								</a>
							</li>
							<li>
								<a href="#">
								<img src="../../assets/images/flags/United-States-of-America.png" width="18"> American Food
								</a>
							</li>
							<li>
								<a href="#">
								<img src="../../assets/images/flags/France.png" width="18"> French Food 
								</a>
							</li>
							<li>
								<a href="#">
								<img src="../../assets/images/flags/Mexico.png" width="18"> Mexican Food 
								</a>
							</li>
					</ul>
				</li>
				<li>
					<a href="GuessFood-Search.html">
						<i class="linecons-search"></i><span class="title">Recipe Database</span>
					</a>
					
				</li>
				
			</ul>
					
			
			<!-- notifications and other links -->
			<ul class="nav nav-userinfo navbar-right">
				
				
				
				
				<li class="dropdown xs-left">
					<a href="#" data-toggle="dropdown" class="notification-icon notification-icon-messages">
						<i class="fa-bell-o"></i>
						<span class="badge badge-purple">7</span>
					</a>
						
					<ul class="dropdown-menu notifications">
										<li class="top">
						<p class="small">
							<a href="#" class="pull-right">Mark all Read</a>
							You have <strong>3</strong> new notifications.
						</p>
					</li>
					
					<li>
						<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
							<li class="active notification-success">
								<a href="#">
									<i class="fa-user"></i>
									
									<span class="line">
										<strong>New user registered</strong>
									</span>
									
									<span class="line small time">
										30 seconds ago
									</span>
								</a>
							</li>
							
							<li class="active notification-secondary">
								<a href="#">
									<i class="fa-lock"></i>
									
									<span class="line">
										<strong>Privacy settings have been changed</strong>
									</span>
									
									<span class="line small time">
										3 hours ago
									</span>
								</a>
							</li>
							
							<li class="notification-primary">
								<a href="#">
									<i class="fa-thumbs-up"></i>
									
									<span class="line">
										<strong>Someone special liked this</strong>
									</span>
									
									<span class="line small time">
										2 minutes ago
									</span>
								</a>
							</li>
							
							<li class="notification-danger">
								<a href="#">
									<i class="fa-calendar"></i>
									
									<span class="line">
										John cancelled the event
									</span>
									
									<span class="line small time">
										9 hours ago
									</span>
								</a>
							</li>
							
							<li class="notification-info">
								<a href="#">
									<i class="fa-database"></i>
									
									<span class="line">
										The server is status is stable
									</span>
									
									<span class="line small time">
										yesterday at 10:30am
									</span>
								</a>
							</li>
							
							<li class="notification-warning">
								<a href="#">
									<i class="fa-envelope-o"></i>
									
									<span class="line">
										New comments waiting approval
									</span>
									
									<span class="line small time">
										last week
									</span>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="external">
						<a href="#">
							<span>View all notifications</span>
							<i class="fa-link-ext"></i>
						</a>
					</li>
					</ul>
				</li>
		
				<li class="dropdown user-profile">
					<a href="#" data-toggle="settings-pane" data-animate="true">
						<img src="../../assets/images/user-1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
						<span>
							Arlind Nushi
							<i class="fa-angle-up"></i>
						</span>

					</a>
					
					
				</li>
				
		
			</ul>
	
		</div>
		
	</nav>

	
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
			
		<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		
		
		<div class="main-content">

			<div class="row">
				<div class="col-sm-7 cuisineExplored">
					<h1>   Spanish Cuisine explored</h1>

					<p><strong>Spanish cuisine is a way of preparing varied dishes, which is enriched by the culinary contributions of the various regions that make up the country. It is a cuisine influenced by the people who, throughout history, have conquered the territory of that country. </strong> </p>
					

					<script type="text/javascript">
								jQuery(document).ready(function($)
								{
									var map = $("#italy");
										map.vectorMap({
											map: 'it_mill_en',
											backgroundColor: 'transparent',
											normalizeFunction: 'polynomial',
											markersSelectable: true,
											regionStyle: {
											  initial: {
												"fill": '#ebebeb',
												"fill-opacity": 0.9,
												"stroke": '#423F37',
												"stroke-width": 1,
												"stroke-opacity": 1
											  },
											  hover: {
												"fill-opacity": 1,
												"fill": "#ddd"
											  }
											},
											markerStyle: {
												initial: {
													fill: '#68b828',
													"stroke": "#fff"
												},
												selected: {
													fill: '#7c38bc'
												}
											},
											markers: [
												{latLng: [41.87, 12.48], name: 'Rome'},
												{latLng: [45.46, 9.18], name: 'Milan'},
												{latLng: [41.11, 16.87], name: 'Bari'},
												{latLng: [37.51, 15.08], name: 'Catania'},
											]
										});
								});
							</script>

					<div id="italy" style="height: 380px;"></div>
												

					<h2>Spanish regional variation: typical dishes</h2>

					<h3>Andalucia</h3>

					<p>Andalusian cuisine is twofold: rural and coastal. Of all the Spanish regions, this region uses the most olive oil in its cuisine. The dish that has achieved the most international fame is Gazpacho. It is a kind of cold soup made with five vegetables, bread, vinegar, water, salt and olive oil. Other cold soups include: pulley, Zoque, salmorejo, etc.</p>

					<p>Snacks made with olives are common. Meat dishes include: flamenquín, pringá, oxtail and often gypsy (also called Andalusian tripe). Among the hot soups are: cat soup (made with bread), dog stew (fish soup with orange juice) and Migas Canas. Fish dishes include: fried fish, cod pavías, and parpandúas. A culinary custom is the typical Andalusian breakfast, considered to be a traditional characteristic of laborers and today extending throughout Spain.</p>

					<p>Cured meats include: Serrano Ham and Jabugo. Typical drinks in the area include: anise, wine (Malaga, Jerez, Pedro Ximénez, etc..) and sherry brandy.</p>

					<h3>Aragon</h3>

					<p>The Aragonese cuisine has a basically rural and mountain origin. The central part of Aragon, the flattest, is the richest in culinary specialties. Being a land of lambs raised on the slopes of the Pyrenees, one of its most famous dishes is roast lamb (asado de ternasco) (with garlic, salt and bacon fat), having the lamb to the shepherd, the heads of lamb and Highlanders asparagus (lamb tails). Pork dishes are also very popular, among them: Magras con tomate, roasted pork leg and Almojábanas de Cerdo. Among the recipes made with bread are: migas de Pastor, migas con chocolate, Regañaos (cakes with sardines or herring) and goguera. The most notable condiment is garlic-oil.</p>

					<p>Legumes are very important and the most popular vegetables are borage and thistle. In terms of cured meats, ham from Teruel and Huesca are famous. Among the cheeses Tronchon is notable. Fruit-based cuisine includes the very popular Fruits of Aragon (Spanish: Frutas de Aragón) and Maraschino cherries.</p>

					



				</div>
				<div class="col-sm-5">

					<h2>Typical dishes of Spanish food:</h2>
					<p>Just featuring the recipes that have been granted by our community or our experts the <a><strong> Certificate of Typical <i  class="fa-certificate"></i> </strong></a>. This is to assure that a dish is somewhat characteristical of this cuisine. 
					<div>
						<button class="btn btn-white ">
										Suggest a Recipe
						</button>
						<button class="btn btn-white">
										Curate recipes
						</button>
					</div>

					
			
					<div class="panel-group" id="accordion-test-2">
					
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2">
										Main Dishes
									</a>
								</h4>
							</div>
							<div id="collapseOne-2" class="panel-collapse collapse in">
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr >
												<th class="middle-align">Name</th>
												<th class="middle-align">From</th>
												
												<th class="LikeCount"><i  class="fa-thumbs-o-up"></i></th>
																							
											</tr>
										</thead>
										
										<tbody>
											<tr>
												<td class="middle-align">Curried Sauteed Cauliflower</td>
												<td class="middle-align">Catalonia</td>
												
												<td class="middle-align LikeCount">1.236</td>
												
												
											</tr>

											<tr>
												<td class="middle-align">Spiced Cauliflower with Sesame Seeds</td>
												<td class="middle-align">Catalonia</td>
												
												
												<td class="middle-align LikeCount">913</td>
												
											</tr>
											<tr>
												<td class="middle-align">Curried Sauteed Cauliflower</td>
												<td class="middle-align">Madrid</td>
												
												<td class="middle-align LikeCount">1.236</td>
												
												
											</tr>

											<tr>
												<td class="middle-align">Spiced Cauliflower with Sesame Seeds</td>
												<td class="middle-align">Tarragona</td>
												
												
												<td class="middle-align LikeCount">913</td>
												
											</tr>
											<tr>
												<td class="middle-align">Curried Sauteed Cauliflower</td>
												<td class="middle-align">Madrid</td>
												
												<td class="middle-align LikeCount">1.236</td>
												
												
											</tr>

											<tr>
												<td class="middle-align">Spiced Cauliflower with Sesame Seeds</td>
												<td class="middle-align">Catalonia</td>
												
												
												<td class="middle-align LikeCount">913</td>
												
											</tr>
											<tr>
												<td class="middle-align">Curried Sauteed Cauliflower</td>
												<td class="middle-align">Catalonia</td>
												
												<td class="middle-align LikeCount">1.236</td>
												
												
											</tr>

											<tr>
												<td class="middle-align">Spiced Cauliflower with Sesame Seeds</td>
												<td class="middle-align">Catalonia</td>
												
												
												<td class="middle-align LikeCount">913</td>
												
											</tr>
											<tr>
												<td class="middle-align">Curried Sauteed Cauliflower</td>
												<td class="middle-align">Catalonia</td>
												
												<td class="middle-align LikeCount">1.236</td>
												
												
											</tr>

											<tr>
												<td class="middle-align">Spiced Cauliflower with Sesame Seeds</td>
												<td class="middle-align">Catalonia</td>
												
												
												<td class="middle-align LikeCount">913</td>
												
											</tr>
										</tbody>
									</table>
									<button class="btn btn-white btn-icon-standalone">
									<i class="linecons-search"></i>
									<span>Browse More</span>
								</button>

								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed">
										Collapsible Group Item #2
									</a>
								</h4>
							</div>
							<div id="collapseTwo-2" class="panel-collapse collapse">
								<div class="panel-body">
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed">
										Collapsible Group Item #3
									</a>
								</h4>
							</div>
							<div id="collapseThree-2" class="panel-collapse collapse">
								<div class="panel-body">
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								</div>
							</div>
						</div>
					
			
				</div>
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
		<!-- end: Chat Section -->
		
		
	</div>
	
	
	
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="../../assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="../../assets/js/select2/select2.css">
	<link rel="stylesheet" href="../../assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="../../assets/js/multiselect/css/multi-select.css">


	<!-- Bottom Scripts -->
	<script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/TweenMax.min.js"></script>
	<script src="../../assets/js/resizeable.js"></script>
	<script src="../../assets/js/joinable.js"></script>
	<script src="../../assets/js/xenon-api.js"></script>
	<script src="../../assets/js/xenon-toggles.js"></script>
	<script src="../../assets/js/moment.min.js"></script>


	<!-- Imported scripts on this page -->
	<script src="../../assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="../../assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="../../assets/js/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="../../assets/js/colorpicker/bootstrap-colorpicker.min.js"></script>
	<script src="../../assets/js/select2/select2.min.js"></script>
	<script src="../../assets/js/jquery-ui/jquery-ui.min.js"></script>
	<script src="../../assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="../../assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="../../assets/js/typeahead.bundle.js"></script>
	<script src="../../assets/js/handlebars.min.js"></script>
	<script src="../../assets/js/multiselect/js/jquery.multi-select.js"></script>

	<script src="../../assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="../../assets/js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../../assets/js/jvectormap/regions/jquery-jvectormap-it-mill-en.js"></script>




	<!-- JavaScripts initializations and stuff -->
	<script src="../../assets/js/xenon-custom.js"></script>

<div class="page-loading-overlay">
				<div class="loader-2"></div>
</div>

</body>
</html>