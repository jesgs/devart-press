<?php
if (!class_exists('WP')) {
	die('You are not allowed to call this page directly.');
}

if (!current_user_can('manage_options')) {
	wp_die(
		__(
			'You do not have sufficient permissions to manage options for this blog.',
			'devart-press'
		)
	);
}
	$auth_nonce = wp_create_nonce( 'devart-press_auth' );
	dump( $_GET );
?>

<div id="devart-press-options" class="wrap">
	<a id="authorize-link" target="_blank" rel="noopener nofollow" href="<?php echo admin_url( 'options-general.php?page=devart-press-options&nonce=' . $auth_nonce . '&request_auth=true' ) ?>">Connect to DeviantArt</a>
</div>