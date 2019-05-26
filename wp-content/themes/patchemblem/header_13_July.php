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
    
    <link rel="icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon.png" />
	
	
	<script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-1.11.3.min.js'></script>	
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.bxslider.js"></script>
	<!--Custom Css & Js - end-->
	
	<script type="text/javascript">
	$(document).ready(function(){
		$('.bxslider1').bxSlider({
			minSlides: 1,
			maxSlides: 1,
			controls: false,

		});

		$('.bxslider').bxSlider({
			speed: 500,
			pager: false,
			controls: true,
			
		});	
		
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



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62036475-1', 'auto');
  ga('require', 'displayfeatures'); 
  ga('send', 'pageview');

</script>


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
        			<!--<div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">-->
					
					
					
                    <div class="navbar-collapse collapse" id="navbar">
						
						<?php wp_nav_menu( array('menu' => 'header_menu','items_wrap'      => '<ul class="nav navbar-nav navbar-right">%3$s</ul>', )); ?>
						
       <!--<ul class="nav navbar-nav navbar-right">
        <li class=""><a href="#">Home</a></li>                            
        <li class=""><a href="#">ABOUT</a></li>
        <li class=""><a href="#">PRICES</a></li>
        <li class=""><a href="#">OPTIONS</a></li>
        <li class=""><a href="#">PRODUCTS</a></li>
        <li class=""><a href="#">GALLERY</a></li>
        <li class=""><a href="#">FAQ</a></li>
        <li class=""><a href="#">ORDER</a></li>
        <li class=""><a href="#">CONTACT</a></li>
        </ul>-->
        </div>
        		</nav>   
        	</div>
    	</div>
    </div>
</header>

<section class="body-sec">
		<?php
		if(is_front_page()){

			$banners = get_posts(array(
				'showposts' => -1,
				'post_type' => 'banner',
				)
			);
			//echo '<pre>';
			//print_r($banners);exit;
			if(count($banners) > 0){
		?>
			<div class="bannerbase">
				<div class="banner">
					<ul class="bxslider">
						<?php
						foreach($banners as $banner){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $banner->ID ), 'full' );
						?>
						<li style="background-image: url('<?php echo $image[0]; ?>')">
                        	<div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                    	<div class="bannerTextNew clearfix">
											<div class="bannerTextNewAreaAgain">
												<?php echo $banner->post_content; ?>
											</div>
											<?php
											$page_banner_image = get_post_meta( $banner->ID, 'banner_image_top' );
											$page_banner_image = wp_get_attachment_image_src( $page_banner_image[0], 'full' );
											?>
											<div class="imageBannerLogoArea"><img src="<?php echo $page_banner_image[0]; ?>"></div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>

			<div class="your-idea">
				<div class="container">
			       	  <h1><?php dynamic_sidebar( 'Bottom Banner Message Area' ); ?></h1>
				</div>
			</div>
		<?php
			}
		}
		?>
		
		
	
