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

//$auth_nonce = wp_create_nonce( 'devart-press_auth' );
$auth_url   = home_url('get-authorization');
?>

<div id="devart-press-options" class="wrap">
	<a id="authorize-link" target="_blank" rel="noopener nofollow" href="<?php echo $auth_url; ?>">Connect to DeviantArt</a>
</div>
<div id="app"></div>