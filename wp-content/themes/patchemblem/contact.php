<?php
/**
 * Template Name: Contact 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div class="whole_pages_pembl">
	<div class="container">
    	<div class="row">

		
        <div class="contactusPageArea clearfix">			
            <div class="col-md-6">
            	<form id="form3" name="form3" class="wufoo leftLabel page" accept-charset="UTF-8" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
      action="https://patchemblem.wufoo.eu/forms/q71g7t109ey75n/#public">
  
<header id="header" class="info">
<h2>Contact Us</h2>

</header>

<ul>

<li id="foli1" class="notranslate clearfix      ">
<label class="desc" id="title1" for="Field1">
Name
<span id="req_1" class="req">*</span>
</label>
<span>
<input id="Field1" name="Field1" type="text" class="field text fn" value="" size="8" tabindex="1" placeholder="First"       required />
<!--<label for="Field1">First</label>-->
</span>
<span>
<input id="Field2" name="Field2" type="text" class="field text ln" value="" size="14" tabindex="2" placeholder="Last" required />
<!--<label for="Field2">Last</label>-->
</span>
</li>
<li id="foli3" class="notranslate      ">
<label class="desc" id="title3" for="Field3">
Email
<span id="req_3" class="req">*</span>
</label>
<div>
<input id="Field3" name="Field3" type="email" spellcheck="false" class="field text medium" value="" maxlength="255" tabindex="3"       required />
</div>
</li>
<li id="foli5"
class="notranslate ScrollText     "><label class="desc" id="title5" for="Field5">
Message
<span id="req_5" class="req">*</span>
</label>

<div>
<textarea id="Field5"
name="Field5"
class="field textarea small"
spellcheck="true"
rows="10" cols="50"

tabindex="4"
onkeyup=""
      required  ></textarea>

</div>
</li>
<li id="foli7" class="notranslate       "  >
<label class="desc" id="title7" for="Field7">
Attach a File
</label>
<div>
<input id="Field7" name="Field7" type="file" class="field file" size="12" tabindex="5"       />
</div>
</li> <li class="buttons ">
<div>

                    <input id="saveForm" name="saveForm" class="btTxt submit"
    type="submit" value="Submit"
 /></div>
</li>

<li class="hide">
<label for="comment">Do Not Fill This Out</label>
<textarea name="comment" id="comment" rows="1" cols="1"></textarea>
<input type="hidden" id="idstamp" name="idstamp" value="th1Ys9KtspunmY6SMCLXyac0ub093L5+JMqFUqB73s4=" />
</li>
</ul>
</form>
			</div>
			<div class="col-md-6 contactAddressArea">
            	<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				//comments_template();
			endif;

		// End the loop.
		endwhile;
		?>
            </div>
		</div>
		</div><!-- .site-main -->
        
        
        
	</div><!-- .content-area -->
</div>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
jQuery().ready(function($) {
	$("#form3").validate({
		rules: {
			Field1: "required",
			Field2: "required",
			Field3: {
				required: true,
				email: true
			},
			Field5: "required",
		},
		messages: {
			Field1: "Please enter your firstname",
			Field2: "Please enter your lastname",
			Field3: "Please enter a valid email address",
			Field5: "Please enter your message",
		}
	});
});
</script>

<?php get_footer(); ?>
