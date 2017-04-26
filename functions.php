<?php

// Ensure the child themes style sheet gets loaded

function bcc_enqueue_styles () {

	wp_enqueue_style (
		'parent-style',
		get_template_directory_uri () . '/style.css'
	);

	wp_enqueue_style (
		'child-style',
		get_stylesheet_directory_uri () . '/style.css',
		array (
			'parent-style'
		),
		wp_get_theme () -> get ( 'Version' )
	);

}

add_action (
	'wp_enqueue_scripts',
	'bcc_enqueue_styles'
);

// Replace the Axel Themes spiel in their footer with a custom copyright notice for Goondiwindi Chamber of Commerce

function custom_copyright () {

	require_once ( 'custom_copyright.php' );

}

function custom_footer () {

	remove_action (
		'business_club_action_footer',
		'business_club_footer_copyright',
		10
	);

	add_action (
		'business_club_action_footer',
		'custom_copyright',
		10
	);

}

add_action (
	'init',
	'custom_footer',
	10
);

/*
 * Change the email address the site sends from
 */

function gcc_mail_from ( $email ) {
	return 'chamber@goondiwindi.qld.au';
}
	
add_filter (
	    'wp_mail_from',
	    'gcc_mail_from'
);

/*
 * Change the From name in emails sent from the site
 */

function gcc_mail_from_name ( $from_name ) {
	
	return 'Goondiwindi Chamber of Commerce';

}

add_filter (
	    'wp_mail_from_name',
	    'gcc_mail_from_name'
);

?>
