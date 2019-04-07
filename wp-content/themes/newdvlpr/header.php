<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title>
		 <?php wp_title('|', 'true', 'right') ?>	
		 <?php bloginfo('name'); ?>
		 </title>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
	</head>
	<body>
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
			  <a class="navbar-brand" href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">

			      <?php
			      	get_search_form();
			       wp_nav_menu(array(
			       	'theme_location' => 'bootstrap-menu',
			       	'menu_class'     => 'navbar-nav justify-content-end',
			       	'container'      => false,
			       	'depth'          => 2,
			       	'walker'         => new wp_bootstrap_navwalker()
			       ));

			      ?>
			    
			  </div>
		  </div>
		</nav>
		


