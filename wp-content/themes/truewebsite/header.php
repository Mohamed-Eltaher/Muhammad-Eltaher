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
	<div class="upper-bar">Free Shipping Worldwide </div>
	<nav class="nav">	
		<div class="container">
			<div class="logo site-title">
				<a href="<?php bloginfo('url') ?>" style="color: <?php echo get_header_textcolor(); ?>"><?php the_custom_logo() ?></a>
			</div>

			<div id="search-icon" class="search">
				<a href="https://bodycheers.com/my-account/"><i class="fas fa-user-circle fa-3x"></i></a>
				<!--<i class="fas fa-search fa-3x"></i> -->
				<li class="cart-mobile wpmenucartli wpmenucart-display-standard menu-item menu-item-type-post_type menu-item-object-page" id="wpmenucartli"><a class="wpmenucart-contents empty-wpmenucart-visible" href="https://bodycheers.com/cart/" title="Start shopping"><i class="wpmenucart-icon-shopping-cart-0"></i><span class="amount">£0.00</span></a></li>
					<!--<a href="<?php // echo wc_get_cart_url(); ?>">
						<i class="fas fa-shopping-cart fa-3x"></i>
					</a> -->
			</div>
			
			<!--
			<div class="registeration"> 
				<?php /*
				if( is_user_logged_in()) { ?>
					
					<span>
						<a href="<?php echo wp_logout_url(); ?>" class="logout">LogOut</a>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( get_current_user_id() ))?>"><?php echo get_avatar(get_current_user_id(), 60); ?></a>
					</span>
				<?php }else { ?>
					<a href="<?php echo wp_login_url(); ?>" class="login">LogIn</a>
					<a href="<?php echo wp_registration_url(); ?>" class="signup">SignUp</a>
				<?php }
				*/ ?>

			</div>
			-->
			<div id="mainListDiv" class="main_list">
				<ul class="navlinks">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
					?>		
				</ul>
				<!--
				<div class="registeration-mob"> 
					<?php /*
					if( is_user_logged_in()) { ?>

						<span>
							<a href="<?php echo wp_logout_url(); ?>" class="logout">LogOut</a>
							<?php echo get_avatar(get_current_user_id(), 60); ?></span>
						<?php }else { ?>
							<a href="<?php echo wp_login_url(); ?>" class="login">LogIn</a>
							<a href="<?php echo wp_registration_url(); ?>" class="signup">SignUp</a>
						<?php }
						*/ ?>
						
				</div> -->
				</div>
				<span class="navTrigger">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</div>
		</nav>

		<!-- live search -->
		<div class="container">
			<div class="live-search">
				<div class="search-form">
					<?php get_search_form(); ?>
					<i class="fas fa-search fa-3x"></i>
					<i class="fas fa-times-circle fa-3x"></i>
				</div>
			</div>
		</div>



