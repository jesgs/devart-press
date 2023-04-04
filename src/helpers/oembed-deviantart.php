<?php
/**
 * Based on:
 *    https://webdevstudios.com/2019/08/15/fixing-oembed/
 *    https://gist.github.com/oddevan/f83a9bae88cf82976663f782075dd1e2#file-eph-daembed-php
 */
namespace JesGs\DevArt\Oembed;

function register_providers() {
	$callback = __NAMESPACE__ . '\handle_deviantart';

	wp_embed_register_handler( 'deviantart-main', '#https://www.deviantart.com/*+#', $callback, 10 );
}

function handle_deviantart( $matches, $attr, $url, $rawattr ): string {
	$http_options = [
		'headers' => [
			'User-Agent'      => 'WordPress OEmbed Consumer',
		],
	];

	$da_response = \wp_remote_get( 'https://backend.deviantart.com/oembed?url=' . rawurlencode( $url ), $http_options );
	if ( empty( $da_response ) || 200 !== $da_response['response']['code'] ) {
		return "<p><!-- Could not embed --><a href=\"{$url}\">View Deviation</a></p>";
	}

	// Generate client-side HTML here

	return 'coming soon!';
}

add_action( 'init', __NAMESPACE__ . '\register_providers' );