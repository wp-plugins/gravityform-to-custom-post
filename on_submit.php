<?php
add_action("gform_after_submission", "set_post_content", 10, 2);
function set_post_content($entry, $form){
	if($form["gfpc_settings"] == "on") {
		
		$post_type = $form["gfpc_settings_post_type"];

	    //getting post
	    $post = get_post($entry["post_id"]);
		$post->post_type = $post_type;

		//change admin to current loggedd in user. also add option to the form setting

	}


    //updating post
    wp_update_post($post);
}
?>