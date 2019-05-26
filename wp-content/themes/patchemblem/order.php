<?php
/**
 * Template Name: Order
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

	<div class="container">
    	<div class="row">

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

		</div><!-- .site-main -->
        
        <div class="col-lg-12 prderPatchArea clearfix">
        	<form id="form2" name="form2" class="wufoo leftLabel page" accept-charset="UTF-8" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
      action="https://patchemblem.wufoo.eu/forms/m1xhnfp81pb3sf3/#public">
  
<header id="header" class="info">
<h2>Patch Order</h2>
<div></div>
</header>

<ul>

<li id="foli1" class="notranslate      ">
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
<li id="foli3" class="notranslate altInstruct     ">
<label class="desc" id="title3" for="Field3">
Email
<span id="req_3" class="req">*</span>
</label>
<div>
<input id="Field3" name="Field3" type="email" spellcheck="false" class="field text medium" value="" maxlength="255" tabindex="3"       required />
</div>
</li>
<li id="foli18" class="notranslate      ">
<label class="desc" id="title18" for="Field18">
Size
</label>
<div>
<input id="Field18" name="Field18" type="text" class="field text medium" value="" maxlength="255" tabindex="4" onkeyup=""       />
</div>
</li>
<li id="foli5" class="notranslate      ">
<label class="desc" id="title5" for="Field5">
Quantity
</label>
<div>
<input id="Field5" name="Field5" type="text" class="field text medium" value="" maxlength="255" tabindex="5" onkeyup=""       />
</div>
</li>
<li id="foli4" class="notranslate       ">
<label class="desc" id="title4" for="Field4">
Category
</label>
<div>
<select id="Field4" name="Field4" class="field select medium"       tabindex="6" >
<option value="Embroidery" selected="selected">
Embroidery
</option>
<option value="Woven" >
Woven
</option>
<option value="Sublimation" >
Sublimation
</option>
<option value="Chenille" >
Chenille
</option>
</select>
</div>
</li>
<li id="foli6"
class="notranslate scrollText     "><label class="desc" id="title6" for="Field6">
Details
</label>

<div>
<textarea id="Field6"
name="Field6"
class="field textarea medium"
spellcheck="true"
rows="10" cols="50"

tabindex="7"
onkeyup=""
       ></textarea>

</div>

<p class="instruct" id="instruct6"><small>Backing and border style? Deadline? </small></p></li>
<li id="foli8" class="complex notranslate      ">
<label class="desc" id="title8" for="Field8">
Address
</label>
<div>
<span class="full addr1">
<input id="Field8" name="Field8" type="text" class="field text addr" value="" tabindex="8"       />
<label for="Field8">Street Address</label>
</span>
<span class="full addr2">
<input id="Field9" name="Field9" type="text" class="field text addr" value="" tabindex="9" />
<label for="Field9">Address Line 2</label>
</span>
<span class="left city">
<input id="Field10" name="Field10" type="text" class="field text addr" value="" tabindex="10" />
<label for="Field10">City</label>
</span>
<span class="right state">
<input id="Field11" name="Field11" type="text" class="field text addr" value="" tabindex="11" />
<label for="Field11">State / Province / Region</label>
</span>
<span class="left zip">
<input id="Field12" name="Field12" type="text" class="field text addr" value="" maxlength="15" tabindex="12" />
<label for="Field12">Postal / Zip Code</label>
</span>
<span class="right country">
<select id="Field13" name="Field13" class="field select addr" tabindex="13" >
<option value="" selected="selected"></option>
<option value="United States" >United States</option>
<option value="United Kingdom" >United Kingdom</option>
<option value="Australia" >Australia</option>
<option value="Canada" >Canada</option>
<option value="France" >France</option>
<option value="New Zealand" >New Zealand</option>
<option value="India" >India</option>
<option value="Brazil" >Brazil</option>
<option value="----" >----</option>
<option value="Afghanistan" >Afghanistan</option>
<option value="Åland Islands" >Åland Islands</option>
<option value="Albania" >Albania</option>
<option value="Algeria" >Algeria</option>
<option value="American Samoa" >American Samoa</option>
<option value="Andorra" >Andorra</option>
<option value="Angola" >Angola</option>
<option value="Anguilla" >Anguilla</option>
<option value="Antarctica" >Antarctica</option>
<option value="Antigua and Barbuda" >Antigua and Barbuda</option>
<option value="Argentina" >Argentina</option>
<option value="Armenia" >Armenia</option>
<option value="Aruba" >Aruba</option>
<option value="Austria" >Austria</option>
<option value="Azerbaijan" >Azerbaijan</option>
<option value="Bahamas" >Bahamas</option>
<option value="Bahrain" >Bahrain</option>
<option value="Bangladesh" >Bangladesh</option>
<option value="Barbados" >Barbados</option>
<option value="Belarus" >Belarus</option>
<option value="Belgium" >Belgium</option>
<option value="Belize" >Belize</option>
<option value="Benin" >Benin</option>
<option value="Bermuda" >Bermuda</option>
<option value="Bhutan" >Bhutan</option>
<option value="Bolivia" >Bolivia</option>
<option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
<option value="Botswana" >Botswana</option>
<option value="British Indian Ocean Territory" >British Indian Ocean Territory</option>
<option value="Brunei Darussalam" >Brunei Darussalam</option>
<option value="Bulgaria" >Bulgaria</option>
<option value="Burkina Faso" >Burkina Faso</option>
<option value="Burundi" >Burundi</option>
<option value="Cambodia" >Cambodia</option>
<option value="Cameroon" >Cameroon</option>
<option value="Cape Verde" >Cape Verde</option>
<option value="Cayman Islands" >Cayman Islands</option>
<option value="Central African Republic" >Central African Republic</option>
<option value="Chad" >Chad</option>
<option value="Chile" >Chile</option>
<option value="China" >China</option>
<option value="Colombia" >Colombia</option>
<option value="Comoros" >Comoros</option>
<option value="Democratic Republic of the Congo" >Democratic Republic of the Congo</option>
<option value="Republic of the Congo" >Republic of the Congo</option>
<option value="Cook Islands" >Cook Islands</option>
<option value="Costa Rica" >Costa Rica</option>
<option value="C&ocirc;te d'Ivoire" >C&ocirc;te d'Ivoire</option>
<option value="Croatia" >Croatia</option>
<option value="Cuba" >Cuba</option>
<option value="Cyprus" >Cyprus</option>
<option value="Czech Republic" >Czech Republic</option>
<option value="Denmark" >Denmark</option>
<option value="Djibouti" >Djibouti</option>
<option value="Dominica" >Dominica</option>
<option value="Dominican Republic" >Dominican Republic</option>
<option value="East Timor" >East Timor</option>
<option value="Ecuador" >Ecuador</option>
<option value="Egypt" >Egypt</option>
<option value="El Salvador" >El Salvador</option>
<option value="Equatorial Guinea" >Equatorial Guinea</option>
<option value="Eritrea" >Eritrea</option>
<option value="Estonia" >Estonia</option>
<option value="Ethiopia" >Ethiopia</option>
<option value="Faroe Islands" >Faroe Islands</option>
<option value="Fiji" >Fiji</option>
<option value="Finland" >Finland</option>
<option value="Gabon" >Gabon</option>
<option value="Gambia" >Gambia</option>
<option value="Georgia" >Georgia</option>
<option value="Germany" >Germany</option>
<option value="Ghana" >Ghana</option>
<option value="Gibraltar" >Gibraltar</option>
<option value="Greece" >Greece</option>
<option value="Grenada" >Grenada</option>
<option value="Guatemala" >Guatemala</option>
<option value="Guinea" >Guinea</option>
<option value="Guinea-Bissau" >Guinea-Bissau</option>
<option value="Guyana" >Guyana</option>
<option value="Haiti" >Haiti</option>
<option value="Honduras" >Honduras</option>
<option value="Hong Kong" >Hong Kong</option>
<option value="Hungary" >Hungary</option>
<option value="Iceland" >Iceland</option>
<option value="Indonesia" >Indonesia</option>
<option value="Iran" >Iran</option>
<option value="Iraq" >Iraq</option>
<option value="Ireland" >Ireland</option>
<option value="Israel" >Israel</option>
<option value="Italy" >Italy</option>
<option value="Jamaica" >Jamaica</option>
<option value="Japan" >Japan</option>
<option value="Jordan" >Jordan</option>
<option value="Kazakhstan" >Kazakhstan</option>
<option value="Kenya" >Kenya</option>
<option value="Kiribati" >Kiribati</option>
<option value="North Korea" >North Korea</option>
<option value="South Korea" >South Korea</option>
<option value="Kuwait" >Kuwait</option>
<option value="Kyrgyzstan" >Kyrgyzstan</option>
<option value="Laos" >Laos</option>
<option value="Latvia" >Latvia</option>
<option value="Lebanon" >Lebanon</option>
<option value="Lesotho" >Lesotho</option>
<option value="Liberia" >Liberia</option>
<option value="Libya" >Libya</option>
<option value="Liechtenstein" >Liechtenstein</option>
<option value="Lithuania" >Lithuania</option>
<option value="Luxembourg" >Luxembourg</option>
<option value="Macedonia" >Macedonia</option>
<option value="Madagascar" >Madagascar</option>
<option value="Malawi" >Malawi</option>
<option value="Malaysia" >Malaysia</option>
<option value="Maldives" >Maldives</option>
<option value="Mali" >Mali</option>
<option value="Malta" >Malta</option>
<option value="Marshall Islands" >Marshall Islands</option>
<option value="Mauritania" >Mauritania</option>
<option value="Mauritius" >Mauritius</option>
<option value="Mexico" >Mexico</option>
<option value="Micronesia" >Micronesia</option>
<option value="Moldova" >Moldova</option>
<option value="Monaco" >Monaco</option>
<option value="Mongolia" >Mongolia</option>
<option value="Montenegro" >Montenegro</option>
<option value="Morocco" >Morocco</option>
<option value="Mozambique" >Mozambique</option>
<option value="Myanmar" >Myanmar</option>
<option value="Namibia" >Namibia</option>
<option value="Nauru" >Nauru</option>
<option value="Nepal" >Nepal</option>
<option value="Netherlands" >Netherlands</option>
<option value="Netherlands Antilles" >Netherlands Antilles</option>
<option value="Nicaragua" >Nicaragua</option>
<option value="Niger" >Niger</option>
<option value="Nigeria" >Nigeria</option>
<option value="Norway" >Norway</option>
<option value="Oman" >Oman</option>
<option value="Pakistan" >Pakistan</option>
<option value="Palau" >Palau</option>
<option value="Palestine" >Palestine</option>
<option value="Panama" >Panama</option>
<option value="Papua New Guinea" >Papua New Guinea</option>
<option value="Paraguay" >Paraguay</option>
<option value="Peru" >Peru</option>
<option value="Philippines" >Philippines</option>
<option value="Poland" >Poland</option>
<option value="Portugal" >Portugal</option>
<option value="Puerto Rico" >Puerto Rico</option>
<option value="Qatar" >Qatar</option>
<option value="Romania" >Romania</option>
<option value="Russia" >Russia</option>
<option value="Rwanda" >Rwanda</option>
<option value="Saint Kitts and Nevis" >Saint Kitts and Nevis</option>
<option value="Saint Lucia" >Saint Lucia</option>
<option value="Saint Vincent and the Grenadines" >Saint Vincent and the Grenadines</option>
<option value="Samoa" >Samoa</option>
<option value="San Marino" >San Marino</option>
<option value="Sao Tome and Principe" >Sao Tome and Principe</option>
<option value="Saudi Arabia" >Saudi Arabia</option>
<option value="Senegal" >Senegal</option>
<option value="Serbia" >Serbia</option>
<option value="Seychelles" >Seychelles</option>
<option value="Sierra Leone" >Sierra Leone</option>
<option value="Singapore" >Singapore</option>
<option value="Slovakia" >Slovakia</option>
<option value="Slovenia" >Slovenia</option>
<option value="Solomon Islands" >Solomon Islands</option>
<option value="Somalia" >Somalia</option>
<option value="South Africa" >South Africa</option>
<option value="Spain" >Spain</option>
<option value="Sri Lanka" >Sri Lanka</option>
<option value="Sudan" >Sudan</option>
<option value="Suriname" >Suriname</option>
<option value="Swaziland" >Swaziland</option>
<option value="Sweden" >Sweden</option>
<option value="Switzerland" >Switzerland</option>
<option value="Syria" >Syria</option>
<option value="Taiwan" >Taiwan</option>
<option value="Tajikistan" >Tajikistan</option>
<option value="Tanzania" >Tanzania</option>
<option value="Thailand" >Thailand</option>
<option value="Togo" >Togo</option>
<option value="Tonga" >Tonga</option>
<option value="Trinidad and Tobago" >Trinidad and Tobago</option>
<option value="Tunisia" >Tunisia</option>
<option value="Turkey" >Turkey</option>
<option value="Turkmenistan" >Turkmenistan</option>
<option value="Tuvalu" >Tuvalu</option>
<option value="Uganda" >Uganda</option>
<option value="Ukraine" >Ukraine</option>
<option value="United Arab Emirates" >United Arab Emirates</option>
<option value="United States Minor Outlying Islands" >United States Minor Outlying Islands</option>
<option value="Uruguay" >Uruguay</option>
<option value="Uzbekistan" >Uzbekistan</option>
<option value="Vanuatu" >Vanuatu</option>
<option value="Vatican City" >Vatican City</option>
<option value="Venezuela" >Venezuela</option>
<option value="Vietnam" >Vietnam</option>
<option value="Virgin Islands, British" >Virgin Islands, British</option>
<option value="Virgin Islands, U.S." >Virgin Islands, U.S.</option>
<option value="Yemen" >Yemen</option>
<option value="Zambia" >Zambia</option>
<option value="Zimbabwe" >Zimbabwe</option>
</select>
<label for="Field13">Country</label>
</span>
</div>
</li>
<li id="foli14" class="phone notranslate      ">
<label class="desc" id="title14" for="Field14">
Phone Number
</label>
<span>
<input id="Field14" name="Field14" type="tel" class="field text" value="" size="3" maxlength="3" tabindex="14"       />
<label for="Field14">###</label>
</span>
<span class="symbol">-</span>
<span>
<input id="Field14-1" name="Field14-1" type="tel" class="field text" value="" size="3" maxlength="3" tabindex="15" />
<label for="Field14-1">###</label>
</span>
<span class="symbol">-</span>
<span>
 <input id="Field14-2" name="Field14-2" type="tel" class="field text" value="" size="4" maxlength="4" tabindex="16" />
<label for="Field14-2">####</label>
</span>
</li>
<li id="foli15" class="notranslate       "  >
<label class="desc" id="title15" for="Field15">
Attachment
</label>
<div>
<input id="Field15" name="Field15" type="file" class="field file" size="12" tabindex="17"       />
</div>
</li>
<li id="foli16" class="notranslate       "  >
<label class="desc" id="title16" for="Field16">
Attachment
</label>
<div>
<input id="Field16" name="Field16" type="file" class="field file" size="12" tabindex="18"       />
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
<input type="hidden" id="idstamp" name="idstamp" value="PEBYZxFlshlSXAq7ow3/0J8sBow10jOPmNHU6iQILdg=" />
</li>
</ul>
</form>
        </div>
        
	</div><!-- .content-area -->

<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
jQuery().ready(function($) {
	$("#form2").validate({
		rules: {
			Field1: "required",
			Field2: "required",
			Field3: {
				required: true,
				email: true
			}
		},
		messages: {
			Field1: "Please enter your firstname",
			Field2: "Please enter your lastname",
			Field3: "Please enter a valid email address"
		}
	});
});
</script>

<?php get_footer(); ?>
