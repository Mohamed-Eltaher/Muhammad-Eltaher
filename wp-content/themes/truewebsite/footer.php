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
		<div class="col-2">
			<p> 2019 Copyright &copy; Eltaher.com . All Rights Reserved.</p>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
