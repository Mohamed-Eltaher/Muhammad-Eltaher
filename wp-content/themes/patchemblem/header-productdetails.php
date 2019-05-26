<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<!--Custom Css & Js - start-->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery.bxslider.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/fonts.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/mediaqueries.css" type="text/css" media="all">
	
	
	<script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-1.11.3.min.js'></script>	
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.bxslider.js"></script>
	<!--Custom Css & Js - end-->
	
	<script type="text/javascript">
	$(document).ready(function(){
		$(window).scroll(function() {
		    if ($(document).scrollTop() > 20){
			$('.site-header').addClass('shrink');
			$('.body-sec').addClass('fixed-head');
		    }
		    else{
			$('.site-header').removeClass('shrink');
			$('.body-sec').removeClass('fixed-head');
		    }
		});
	});
	</script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	 <!--[if lt IE 9]>
		<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
		<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="site-header">
	<div class="container">
    	<div class="logo_base">
        	<div class="logo"><a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt=""></a></div>
        </div>
    </div>
    <div class="header_top">
    	<div class="container">
        	<div class="row">
        	<div class="header_top_right">
            	
                	<div class="top_quote">
                    	<div class="left_quote_pt">&nbsp;</div>
                        <div class="md_quote_pt"><a href="<?php echo esc_url( home_url('free-quote') ); ?>" style="display: block; text-decoration: none; color: inherit;">Free Quote</a></div>
                        <div class="right_quote_pt">&nbsp;</div>
                    </div>
                	<div class="headtop_contact">
                		<?php dynamic_sidebar( 'Header Contact Area' ); ?>
                    </div>
            </div>
        	</div>
        </div>
    </div>
    <div class="navigation_bar">
    	<div class="container">
    		<div class="row">
        		<nav class="navbar navbar-default" role="navigation">
        			<div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        			
					
					
					
                    <div class="navbar-collapse collapse" id="navbar">
						
						<?php wp_nav_menu( array('menu' => 'header_menu','items_wrap'      => '<ul class="nav navbar-nav navbar-right">%3$s</ul>', )); ?>
						
       
        </div>
        		</nav>   
        	</div>
    	</div>
    </div>
</header>

<section class="body-sec">
		
			
		
		
		
	
