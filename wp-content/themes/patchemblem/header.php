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
	<meta name="google-site-verification" content="Db9dxA3junpi98lFxz0ttMT_uIwGy_GJuj85z9pczXA" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
    <meta name="robots" content="index, follow" />
	<meta name="msvalidate.01" content="AEA1BC7850533FE90BCF670008D6DEE3" />
	<meta name="alexaVerifyID" content="6ziGD0uVU5X48vkpAVbkg2DN6KU"/>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="https://www.patch-emblem.com/xmlrpc.php">
	<?php //bloginfo( 'pingback_url' ); ?>

	<!--Custom Css & Js - start-->
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Vollkorn:400,700" rel="stylesheet"> 
 	<link href="https://fonts.googleapis.com/css?family=Sanchez" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet"> 
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery.bxslider.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/fonts.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css?<?php echo time();?>" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/mediaqueries.css?<?php echo time();?>" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/custom.css?<?php echo time();?>" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/slick.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/slick-theme.css">
    <link rel="icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon.png" />
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Oswald:200,300,400,500,600,700" rel="stylesheet">
	 <!-- css end -->
	 <!-- js start -->
        <script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-1.11.3.min.js' async></script>
	   <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js" defer></script>
	     <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.bxslider.js" defer></script>
        <!--Custom Css & Js - end-->
        <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.validate.js" defer></script>
        <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/css/slick.js" type="text/javascript" charset="utf-8" defer></script>
        <!-- js end -->
	<?php wp_head(); ?>

	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-62036475-1', 'auto');
			ga('require', 'displayfeatures'); 
			ga('send', 'pageview');
		</script>
		<script>
		(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5821324"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");
		</script>
		<noscript><img src="//bat.bing.com/action/0?ti=5821324&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>
</head>



<body <?php body_class(); ?>>
<header>
	<div class="top_annou_on_mb">
		<div class="info_sec container">
			<div class="headtop_contact">
				<?php  dynamic_sidebar( 'Header Contact Area' ); ?>
			</div>
		</div>
	</div>
	<div class="header-top-ss">
		<div class="container-fluid_nav-bar">
			<div class="row_bar_nav">
				<div class="logo_sec-nav-Bar">
					<div class="logo_sec">
						<a href="<?php echo esc_url( home_url() ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="Logo">
						</a>
					</div>	
				</div>
				<div class="col_next-nav-BaR">
					<div class="WraP-Cntn-nav_baR">
					<div class="info_sec">
						<div class="headtop_contact">
			    			<?php  dynamic_sidebar( 'Header Contact Area' ); ?>
			            </div>
			        </div>  
			        <div class="mobile_view_hp">
						<h2>MENU</h2>
					</div>  
				</div>
				<div class="header_ss" id="dEskTop_nav">
					<div class="innEr-Part">
						<div class="header_wrap">
							<div class="row">
								<div class="col-sm-9">
									<div class="menu_sec">
										<?php wp_nav_menu( array('menu' => 'header_menu','items_wrap'=> '<ul class="nav navbar-nav navbar-right classet">%3$s</ul>', )); ?>
									</div>	
								</div>
								<div class="col-sm-3">
									<div class="req_sec">
										<div class="request_quote"> <h3><a href="<?php echo home_url();?>/free-quote/">Request Free Quote</a></h3> </div>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
				</div>
				<div class="toggle_bar">
                    <i class="fa fa-bars" aria-hidden="true"></i>
				</div>
			</div>	
		</div>	
	</div>
	<div class="header_ss" id="mobilE_nav">
		<div class="innEr-Part">
			<div class="header_wrap">
				<div class="row">
					<div class="col-sm-9">
						<div class="menu_sec">
							<?php wp_nav_menu( array('menu' => 'header_menu','items_wrap'=> '<ul class="nav navbar-nav navbar-right classet">%3$s</ul>', )); ?>
						</div>	
					</div>
					<div class="col-sm-3">
						<div class="req_sec">
							<div class="request_quote"> <h3><a href="<?php echo home_url();?>/free-quote/">Request Free Quote</a></h3> </div>
						</div>
					</div>
				</div>
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
			if(count($banners) > 0){
		?>
			<div class="bannerbase only_on_home" style="background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/patch-emblem-desto.jpg');">
				<div class="banner">
                	<div class="container">
                		<div class="row">
                			<div class="col-sm-5">
			                    <div class="bannerNew2Area4clnt" style="float: left;">
									<div class="slider">
										<section class="regular slider">
										    
										    <div>
										      <p>Access Our Great Designs or<br> Share Yours,for</p>
										      <h2>custom patches</h2>
										      <ul>
										        <li>Free Setup &amp; Artwork</li>
										        <li>Free Sample &amp; Edits</li>
										        <li>Free up to 12 colors</li>
										        <li>Five days Delivery Available</li>
										        <li>Factory Direct Prices</li>
										        <li>100% Money Back Guarantee</li>
										      </ul>
										    </div>
										  </section>
									</div>
								</div>
							</div>
							<div class="col-sm-5 pull-right">
								<div class="form_in_mobile container">
									<div class=" Quote-form" data-toggle="modal" data-target="#exampleModalCenter">Free Quote Request</div>
									<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									  <div class="modal-dialog modal-dialog" role="document">
									    <div class="modal-content">
									      
									      <div class="modal-body">
									        	<div class="bannerform_positionbox ">
							                		<div class="freequote_banner_form">
								                		<div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													          <span aria-hidden="true">&times;</span>
													        </button>
												        </div>
							                            <div class="freeQuoteArea">
															<form id="form1" name="form1" class="wufoo leftLabel page" accept-charset="UTF-8" autocomplete="off" enctype="multipart/form-data" method="post" novalidate action="https://patchemblem.wufoo.com/forms/z1vdddc51hk3rvn/#public">
																<header id="header" class="info"><h2>Get a Free Quote</h2></header>
							                                	<ul>
																	<li id="foli1" class="notranslate">
																		<span>
																			<input id="Field1" name="Field1" type="text" class="field text fn" value="" size="8" tabindex="1"  placeholder="First Name *" required />
																		</span>
																		<span>
																			<input id="Field2" name="Field2" type="text" class="field text ln" value="" size="14" tabindex="2" placeholder="Last Name *" required />
																		</span>
																	</li>
																	<li id="foli4" class="notranslate">
																	<span>
																		<input id="Field4" name="Field4" type="email" spellcheck="false" class="field text medium" value="" placeholder="Email *" maxlength="255" tabindex="3" required />						</span>

									                                    <span>
									                                    <input id="Field5" name="Field5" type="text" class="field text medium" value="" placeholder="Size" maxlength="255" tabindex="4" onkeyup="" />
									                                    </span>
																	</li>
																	<li id="foli6" class="notranslate">
																		<span>
																			<input id="Field6" name="Field6" type="text" class="field text medium" value="" placeholder="Quantity" maxlength="255" tabindex="5" onkeyup=""/>
										                                </span>
										                                <span>
										                                	<select id="Field7" name="Field7" class="field select medium" tabindex="6"  >
																				<option selected="selected">Backing</option>

																				<option value="Sew On">Sew On</option>

																				<option value="Iron On" >Iron On</option>

										                                        <option value="Stick on" >Stick on</option>

																				<option value="Velcro hook side" >Velcro hook side</option>

										                                        <option value="Velcro hook & loop side" >Velcro hook & loop side</option>

																			</select>
										                                </span>
																	</li>
																	<li id="foli113" class="notranslate scrollText">
																		<div>
																			<textarea id="Field113" name="Field113" class="field textarea small" placeholder="Details" spellcheck="true" rows="10" cols="50" tabindex="7" onkeyup="" ></textarea>
																		</div>
																		<p class="instruct" id="instruct113"><small>Backing and border style?</small></p>
																	</li>
																	<li id="foli114" class="notranslate">
																		<div class="input-file-div">
																			<input id="Field114" name="Field114" type="file" class="field file" size="12" tabindex="8"/>
																			<button>Choose File</button>
																		</div>
																	</li> 
																	<li class="buttons ">
																		<div>
																			<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Submit" />
																		</div>
																		<div class="modal-footer">
																	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	        
																	    </div>
																	</li>
																	<li class="hide">
																		<label for="comment">Do Not Fill This Out</label>
																		<textarea name="comment" id="comment" rows="1" cols="1"></textarea>
																		<input type="hidden" id="idstamp" name="idstamp" value="kbObp4A1P39mb4+pw/zQjTRFVPJdsydDxIlil26zul0=" />
																	</li>
																</ul>
															</form>
							                 			</div>
													</div>
							                     </div>
									      </div>
									      
									    </div>
									  </div>
									</div>
								</div>
			                    <div class="bannerform_positionbox mobile-responsive">
			                		<div class="freequote_banner_form">
			                            <div class="freeQuoteArea">
			                            
											<form id="form1" name="form1" class="wufoo leftLabel page" accept-charset="UTF-8" autocomplete="off" enctype="multipart/form-data" method="post" novalidate action="https://patchemblem.wufoo.com/forms/z1vdddc51hk3rvn/#public">
												<header id="header" class="info"><h2>Get a Free Quote</h2></header>
			                                	<ul>
													<li id="foli1" class="notranslate">
														<span>
															<input id="Field1" name="Field1" type="text" class="field text fn" value="" size="8" tabindex="1"  placeholder="First Name *" required />
														</span>
														<span>
															<input id="Field2" name="Field2" type="text" class="field text ln" value="" size="14" tabindex="2" placeholder="Last Name *" required />
														</span>
													</li>
													<li id="foli4" class="notranslate">
													<span>
														<input id="Field4" name="Field4" type="email" spellcheck="false" class="field text medium" value="" placeholder="Email *" maxlength="255" tabindex="3" required />						</span>

					                                    <span>
					                                    <input id="Field5" name="Field5" type="text" class="field text medium" value="" placeholder="Size" maxlength="255" tabindex="4" onkeyup="" />
					                                    </span>
													</li>
													<li id="foli6" class="notranslate">
														<span>
															<input id="Field6" name="Field6" type="text" class="field text medium" value="" placeholder="Quantity" maxlength="255" tabindex="5" onkeyup=""/>
						                                </span>
						                                <span>
						                                	<select id="Field7" name="Field7" class="field select medium" tabindex="6"  >
																<option selected="selected">Backing</option>

																<option value="Sew On">Sew On</option>

																<option value="Iron On" >Iron On</option>

						                                        <option value="Stick on" >Stick on</option>

																<option value="Velcro hook side" >Velcro hook side</option>

						                                        <option value="Velcro hook & loop side" >Velcro hook & loop side</option>

															</select>
						                                </span>
													</li>
													<li id="foli113" class="notranslate scrollText">
														<div>
															<textarea id="Field113" name="Field113" class="field textarea small" placeholder="Details" spellcheck="true" rows="10" cols="50" tabindex="7" onkeyup="" ></textarea>
														</div>
														<p class="instruct" id="instruct113"><small>Backing and border style?</small></p>
													</li>
													<li id="foli114" class="notranslate">
														<div class="input-file-div">
															<input id="Field114" name="Field114" type="file" class="field file" size="12" tabindex="8"/>
															<button>Choose File</button>
														</div>
													</li> 
													<li class="buttons ">
														<div>
															<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Submit" />
														</div>
													</li>
													<li class="hide">
														<label for="comment">Do Not Fill This Out</label>
														<textarea name="comment" id="comment" rows="1" cols="1"></textarea>
														<input type="hidden" id="idstamp" name="idstamp" value="kbObp4A1P39mb4+pw/zQjTRFVPJdsydDxIlil26zul0=" />
													</li>
												</ul>
											</form>
			                 			</div>
									</div>
			                     </div>
			                    </div>
			                </div>
		              	 </div> 
				</div>
			</div>
			<div class="your-idea">
				<div class="container">
			       	<?php dynamic_sidebar( 'Bottom Banner Message Area' ); ?>
				</div>
			</div>
		<?php
			}
		}else{
			global $post;
			if( $post->ID != 805 && $post->ID != 63 && $post->ID != 130):
		?>

			<div class="other_page_header_pembl bannerbase" style="background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/patch-otherpage-ban.png');">
				<div class="banner">
                	<div class="container">
                		<div class="row">
                			<div class="col-sm-12">
			                    <div class="bannerNew2Area4clnt" style="float: left;">
									<div class="slider all_page_headernn">
										<h2> <?php echo the_title();?></h2>
									</div>
								</div>
							</div>
			            </div>
		            </div>    
				</div>
			</div>
			<!-- <script type="text/javascript">
				jQuery(document).ready(function(){
   					jQuery('head').append('<meta name="viewport" content="width=device-width, initial-scale=1" />');
				});
			</script> -->
		<?php 
		 endif;
		}

		?>
		

		

	