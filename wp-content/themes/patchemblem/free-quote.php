<?php /** * Template Name: Free Quote * * This is the template that displays all pages by default. * Please note that this is the WordPress construct of pages and that * other "pages" on your WordPress site will use a different template. * * @package WordPress * @subpackage Twenty_Fifteen * @since Twenty Fifteen 1.0 */ get_header(); ?>
<div class="whole_pages_pembl">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 freeQuoteArea clearfix">
				<form id="form1" name="form1" class="wufoo leftLabel page" accept-charset="UTF-8" autocomplete="off" enctype="multipart/form-data" method="post" novalidate action="https://patchemblem.wufoo.com/forms/z1vdddc51hk3rvn/#public">
				      <header id="header" class="info">
				        <h2 class="">Free Quote</h2>
				        <div class=""></div>
				      </header>
				      <ul class="freequotepage_form">
				        <li id="foli1" class="notranslate      ">
				          <label class="desc" id="title1" for="Field1">Name
				<span id="req_1" class="req">*</span>
				          </label>
				<span>
				<input id="Field1" name="Field1" type="text" class="field text fn" value="" size="8" tabindex="1" placeholder=""       required />
				<!-- <label for="Field1">First</label> -->
				</span>
				          <span>
				<input id="Field2" name="Field2" type="text" class="field text ln" value="" size="14" tabindex="2" placeholder="" required />
				<!-- <label for="Field2">Last</label> -->
				</span>
				        </li>
				        <li id="foli4" class="notranslate      ">
				          <label class="desc" id="title4" for="Field4">Email
				<span id="req_4" class="req">*</span>
				          </label>
				          <div>
				            <input id="Field4" name="Field4" type="email" spellcheck="false" class="field text medium" value="" maxlength="255" tabindex="3" placeholder="" required />
				          </div>
				        </li>
				        <li id="foli5" data-wufoo-field data-field-type="text" class="notranslate      ">
				          <label class="desc" id="title5" for="Field5">Size</label>
				          <div>
				            <input id="Field5" name="Field5" type="text" class="field text medium" value="" maxlength="255" tabindex="4" onkeyup="" placeholder="" />
				          </div>
				        </li>
				        <li id="foli6" data-wufoo-field data-field-type="text" class="notranslate      ">
				          <label class="desc" id="title6" for="Field6">Quantity</label>
				          <div>
				            <input id="Field6" name="Field6" type="text" class="field text medium" value="" maxlength="255" tabindex="5" onkeyup="" placeholder="" />
				          </div>
				        </li>
				        <li id="foli7" class="      ">
				          <label class="desc notranslate" id="title7" for="Field7">Backing</label>
				          <div>
				            <select id="Field7" name="Field7" class="field select medium" tabindex="6" data-wufoo-field="dropdown">
				              <option value="Sew On" selected="selected">
				<span class="notranslate">Sew On</span>
				              </option>
				              <option value="Iron on">
				<span class="notranslate">Iron on</span>
				              </option>
				              <option value="Adhesive">
				<span class="notranslate">Adhesive</span>
				              </option>
				              <option value="Velcro">
				<span class="notranslate">Velcro</span>
				              </option>
				            </select>
				          </div>
				        </li>
				        <li id="foli113" class="notranslate scrollText     ">
				          <label class="desc" id="title113" for="Field113">Details</label>
				          <div>
				            <textarea id="Field113" name="Field113" class="field textarea small" spellcheck="true" rows="10" cols="50" tabindex="7" onkeyup="" placeholder=""></textarea>
				          </div>
				        </li>
				        <li id="foli114" class="notranslate       ">
				          <label class="desc" id="title114" for="Field114">Attachment</label>
				          <div>
				            <input id="Field114" name="Field114" type="file" class="field file" size="12" data-file-max-size="10" tabindex="8" data-wufoo-field="file-upload" />
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
				<div class="col-md-6 contactAddressArea">
					<?php // Start the loop. while ( have_posts() ) : the_post(); // Include the page content template. get_template_part( 'content', 'page' ); // If comments are open or we have at least one comment, load up the comment template. if ( comments_open() || get_comments_number() ) : //comments_template(); endif; // End the loop. endwhile; ?>
				</div>
			</div>
		</div>
		<!-- .site-main -->
	</div>
	<!-- .content-area -->
</div>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
	jQuery().ready(function($) {
	
		$("#form1").validate({
	
			rules: {
	
				Field1: "required",
	
				Field2: "required",
	
				Field4: {
	
					required: true,
	
					email: true
	
				}
	
			},
	
			messages: {
	
				Field1: "Please enter your firstname",
	
				Field2: "Please enter your lastname",
	
				Field4: "Please enter a valid email address"
	
			}
	
		});
	
	});
</script>

<?php get_footer(); ?>