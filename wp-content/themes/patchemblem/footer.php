<?php/** * The template for displaying the footer * * Contains the closing of the "site-content" div and all content after. * * @package WordPress * @subpackage Twenty_Fifteen * @since Twenty Fifteen 1.0 */?>
    </section>
    <footer style="display:none;">
        <div class="container">
            <?php wp_nav_menu( array('menu' => 'footer_menu','items_wrap'      => '<div class="footer-menu">%3$s</div>', )); ?>
                <div class="col-sm-9 copyright">
                    <?php dynamic_sidebar( 'Footer Copyright Area' ); ?>
                </div>
                <div class="col-sm-3 social-media">
                    <?php dynamic_sidebar( 'Footer Social Icons Area' ); ?>
                </div>
                <!--<div class="got-questions"><a href="#">Got Questions ? <i class="fa fa-angle-up"></i></a></div>--></div>
    </footer>
    <footer class="v-footer">
        <div class="v-first-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 v-second-ftr-bx">
                        <div class="v-footer-heading">
                            <h3>Contact Us</h3></div>
                            <div class="address_location">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <p>No. 208 building, Xiahenglang Village, Longhua Shenzhen Guangdong 518109, China</p>
                            </div>
                            <div class="call_number">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <p>
                                    (86-755)28826180
                                </p>
                            </div>
                            <div class="envalope_email">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <p>
                                    <a href="mailto:sales@Patch-emblem.com">Email: sales@patch-emblem.com</a>
                                </p>
                            </div>
                            <div class="v-footer-heading free_quote">
                        <div class="req_sec"><div class="request_quote"><h3><a href="https://www.patch-emblem.com/free-quote/">Request Free Quote</a></h3></div></div>
                        </div> 
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 v-first-ftr-bx">
                        <div class="mrg_lft-top">
                        <div class="v-footer-heading custom_class_quick">
                            <h3>QUICK LINKS</h3></div>
                        <div class="link_quick">
                            <?php wp_nav_menu( array('menu' => 'footer_menu','items_wrap'      => '<div class="footer-menu">%3$s</div>', )); ?> 					
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-4 col-md-4 v-forth-ftr-bx">
                        <div class="v-footer-heading">
                            <h3>Follow us</h3>
                             <ul>
                        <li>
                            <a href="https://www.facebook.com/patchemblem" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/patchemblem" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="https://www.patch-emblem.com/blog/" target="_blank">
                            <i class="fa fa-rss" aria-hidden="true"></i>
                            </a>
                        </li>
                           </ul>
                        </div>

                        <div class="v-footer-heading">
                            <h3>payment methods</h3>
                            <span><img src=" <?php echo get_template_directory_uri(); ?>/images/payment-methods-icons.png" alt="" /></span> 
                        </div>
                         
                        </div>
                </div>
            </div>
        </div>
        <div class="v-copyright-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 ">
                        <p>Copyright © 2018 Patch-emblem.com . All Rights Reserved.</p>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 designd-by-name ">
                        <p>Developed by <a target="_blank" href="https://www.zestard.com/open-source-development/wordpress-development/"> Zestard Technologies</a></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
       
        <script type="text/javascript">
        script.async = false; 
        [
          'jQuery.js',
          'main.js'
        ].forEach(function(src) {
          var script = document.createElement('script');
          script.src = src;
          script.async = false; 
          document.head.appendChild(script);
        });
        </script>
        <script>
            jQuery("li.menu-item").hover(function() { // mouse enter
                jQuery(this).find(" > .sub-menu").show(); // display immediate child

            }, function() { // mouse leave
                if (!jQuery(this).hasClass("current_page_item")) { // check if current page
                    jQuery(this).find(".sub-menu").hide(); // hide if not current page
                }
            });
            jQuery(document).ready(function() {
                var offset = 300;
                var duration = 120;
                jQuery(window).scroll(function() {
                    if (jQuery(this).scrollTop() > offset) {
                        jQuery('.quoteAnchor').fadeIn(duration);
                    } else {
                        jQuery('.quoteAnchor').fadeOut(duration);
                    }
                });
                
            });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                        jQuery('.bxslider1').bxSlider({
                            minSlides: 1,
                            maxSlides: 1,
                            controls: false,
                        });
                        jQuery('#form1').validate({
                            rules: {
                                Field1: {
                                    required: true,
                                },
                                Field2: {
                                    required: true,
                                },
                                Field4: {
                                    required: true,
                                    email: true,
                                }
                            },
                            messages: {
                                Field1: {
                                    required: "First Name Required",
                                },
                                Field2: {
                                    required: "Last Name Required",
                                },
                                Field4: {
                                    required: "Email Required",
                                    email: "Enter Valid Email",
                                }
                            },
                        });
                        jQuery('.bxslider').bxSlider({
                            speed: 500,
                            pager: false,
                            controls: true,
                        });
                        // $(window).scroll(function() {
                        //             if ($(document).scrollTop() > 20) { //$('.site-header').addClass('shrink');			//$('.body-sec').addClass('fixed-head');		    }		    else{			//$('.site-header').removeClass('shrink');			//$('.body-sec').removeClass('fixed-head');		    }		});	
                    });
        </script>
        <script>
        jQuery('.toggle_bar').click(function(){
                  jQuery('.header_ss').toggle('slow');
                });
            jQuery(document).ready(function() {
                jQuery('#myModal').on('shown.bs.modal', function () {
                  jQuery('#myInput').trigger('focus');
                });
            });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
              
              jQuery(".regular").slick({
                dots: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
              });
              
            });
            
        </script>
        <a class="quoteAnchor" style="display: none;" href="<?php echo site_url(); ?>/free-quote">Get A Quote</a>
        
        <?php wp_footer(); ?>
            <!-- Google Tag Manager (noscript) -->
            
            <!-- End Google Tag Manager (noscript) -->
            </body>

            </html>