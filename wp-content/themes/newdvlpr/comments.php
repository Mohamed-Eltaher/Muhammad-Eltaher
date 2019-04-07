	<hr>
	<h3> <?php comments_number(); ?></h3>

	<?php

	if(comments_open()) {

		echo "<ul class='list-unstyled posts-comments'>";

		$comments_arguments=array(
			'max_depth'   => 3,
			'type'        => 'comment',
			'avatar_size' =>64
 
		);

		wp_list_comments($comments_arguments);

		echo"</ul>";

		comment_form();
		

	}else {
		echo "sorry, comments are disabled";
	}
