<?php
/**
 * Template Name: Faq
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Patch Emblem 1.0
 */

get_header(); ?>
<div class="whole_pages_pembl">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 faqPageArea clearfix categories_panel fatpageArea">
            	<div class="faqheadertxt">FREQUENTLY ASKED QUESTIONS</div>
				
				<?php
				$args = array(
					'orderby' => 'ID',
					'order'            => 'DESC',
					'post_type' => 'faq',
					'posts_per_page' => -1
				);
				$faq_posts = get_posts( $args );
				//echo '<pre>';print_r($product_posts);die();
				if(count($faq_posts) > 0){
				?>
				
                <ul id="top_ul">
					
					<?php
					foreach($faq_posts as $faq_post){
					?>
					
                	<li class="top_li">
                    	<span class="plus_sub pull-left"><i class="fa fa-minus-square"></i><i class="fa fa-plus-square"></i></span>
                        <h3><?php echo $faq_post->post_title; ?></h3>

			<?php
			$template_url = esc_url( home_url() ) . '/';
		   	?>
                    	<p class="panel2"><?php echo str_replace('[SITE_URL]', $template_url, nl2br($faq_post->post_content)); ?></p>
                    </li>
					
					<?php
					}
					?>
					
                </ul>
                <div class="height100"></div>
				<?php
				}
				?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
 //tab
 	$('.categories_panel ul li:first-child span').addClass('activated');
    $('#myTab a').click(function (e) {
   e.preventDefault()
   $(this).tab('show')
 });
 $('.categories_panel ul li').on('click','span.plus_sub',function(){
  var $this=$(this);
  //$('.categories_panel ul li ul').slideUp();
  $this.parent().children('p').slideToggle();
  $this.toggleClass('activated');
 });
});
</script>
<?php get_footer(); ?>

