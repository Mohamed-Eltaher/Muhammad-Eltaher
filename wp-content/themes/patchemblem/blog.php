<?php
/**
 * Template Name: blog
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

	<div class="container">
    	<div class="row">
    		
    		<div class="col-xs-12">
    			<div class="faqheadertxt">BLOG</div>
    			<div class="blogPageArea clearfix categories_panel blogpageArea">
				
				<?php
				$args = array(
					'orderby' => 'ID',
					'order'            => 'DESC',
					'post_type' => 'blog',
					'posts_per_page' => -1
				);
				$blog_posts = get_posts( $args );
				//echo '<pre>';print_r($product_posts);die();
				if(count($blog_posts) > 0){
				?>
				

					<?php
					foreach($blog_posts as $blog_post){
					    //echo "<pre>"; print_r($blog_post);die;
					?>
					<div class="page-blogs">
                      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog_post->ID ), 'medium' ); ?>
                      <img src="<?php echo $image[0]; ?>"/>
                        <div class="blog-title">
                            <h3><a href="<?php echo $blog_post->guid; ?>"><?php echo $blog_post->post_title; ?></a></h3>
                        </div>

            			<?php
            			$template_url = esc_url( home_url() ) . '/';
            		   	?>
                        	<p class="panel2"><?php echo str_replace('[SITE_URL]', $template_url, wp_trim_words(($blog_post->post_content), 20, '...')); ?></p>
                        	</div>
					<?php
					}
					?>
					
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