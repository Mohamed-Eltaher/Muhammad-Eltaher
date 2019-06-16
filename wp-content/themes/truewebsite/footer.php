<div class="before-footer">
	<div class="container">
		<div class="gurantee">
			<ul>
				<li> <i class="fas fa-plane fa-2x"></i>Worldwide Shipping</li>
				<li><i class="fas fa-lock fa-2x"></i>Payment Security</li>
				<li><i class="fas fa-headset fa-2x"></i>24/7 Customer Service</li>
				<li><i class="fas fa-undo fa-2x"></i>14 Day Money Back Guarantee</li>
			</ul>
		</div>
	</div>
	
</div>
<div id="colophon" class="site-footer">
	<div class="container">
		<div class="col-1">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
				) );
				?>		
		</div>
	</div>
	<div class="col-2">
		<div class="container">
			<p> 2019 Copyright &copy; Eltaher.com . All Rights Reserved.</p>
			<img src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/https://www.patch-emblem.com/wp-content/themes/patchemblem/images/payment-methods-icons.png" alt="">
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
