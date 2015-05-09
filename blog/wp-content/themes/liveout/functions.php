<?php
add_theme_support( 'post-thumbnails' );
if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title' 	=> 'LiveOut Settings',
			'menu_title'	=> 'LiveOut Settings',
			'menu_slug' 	=> 'liveout-settings',
			'capability'	=> 'edit_posts',
			'redirect'	=> false
		));
		
	
	}
