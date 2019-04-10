<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hamo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Header Section -->
	<nav class="nav">	
		<div class="container">
			<div class="logo">
				<a href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>
			</div>

			<div id="search-icon" class="search">
				<i class="fas fa-search fa-3x"></i>
			</div>
			
			<div class="registeration"> 
				<?php
				if( is_user_logged_in()) { ?>
					
					<span>
						<a href="<?php echo wp_logout_url(); ?>" class="logout">LogOut</a>
						<?php echo get_avatar(get_current_user_id(), 60); ?></span>
					<?php }else { ?>
						<a href="<?php echo wp_login_url(); ?>" class="login">LogIn</a>
						<a href="<?php echo wp_registration_url(); ?>" class="signup">SignUp</a>
					<?php }
					?>

				</div>


				<div id="mainListDiv" class="main_list">
					<ul class="navlinks">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
						?>		
					</ul>
					<div class="registeration-mob"> 
						<?php
						if( is_user_logged_in()) { ?>
							
							<span>
								<a href="<?php echo wp_logout_url(); ?>" class="logout">LogOut</a>
								<?php echo get_avatar(get_current_user_id(), 60); ?></span>
						<?php }else { ?>
							<a href="<?php echo wp_login_url(); ?>" class="login">LogIn</a>
							<a href="<?php echo wp_registration_url(); ?>" class="signup">SignUp</a>
						<?php }
						?>
						
					</div>
				</div>
				<span class="navTrigger">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</div>
		</nav>

		<!-- live search -->

		<div class="live-search">
			<div class="search-form">
				<?php get_search_form(); ?>
				<i class="fas fa-search fa-3x"></i>
				<i class="fas fa-times-circle fa-3x"></i>
			</div>
		</div>



