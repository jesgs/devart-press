<?php
/**
 * Based on:
 *    https://webdevstudios.com/2019/08/15/fixing-oembed/
 *    https://gist.github.com/oddevan/f83a9bae88cf82976663f782075dd1e2#file-eph-daembed-php
 */
namespace JesGs\DevArt\Oembed;

/**
 * @return void
 */
function register_providers() {
	$callback = __NAMESPACE__ . '\handle_deviantart';

	wp_embed_register_handler( 'deviantart-main', '#https://www.deviantart.com/*+#', $callback, 10 );
}

/**
 * @param $matches
 * @param $attr
 * @param $url
 * @param $rawattr
 *
 * @return string
 */
function handle_deviantart( $matches, $attr, $url, $rawattr ): string {
	global $post_id;

	/**
	 * Cache the results of the embed to the post's metadata so we're not hitting the API
	 * more than necessary
	 *
	 * @var int $time_to_expiration When the meta field should be refreshed
	 * @var string $cached_response Cached JSON response object
	 */
	$time_to_expiration = get_post_meta( $post_id, '_deviantart_embed_expires', true );
	$da_response_body   = get_post_meta( $post_id, '_deviantart_embed', true );

	if ( time() > $time_to_expiration || empty( $cached_response ) ) {

		$http_options = [
			'headers' => [
				'User-Agent' => 'WordPress OEmbed Consumer',
			],
		];

		$da_response = \wp_remote_get( 'https://backend.deviantart.com/oembed?url=' . rawurlencode( $url ), $http_options );
		if ( empty( $da_response ) || 200 !== $da_response['response']['code'] ) {
			return "<p><!-- Could not embed --><a href=\"{$url}\">View Deviation</a></p>";
		}

		add_post_meta( $post_id, '_deviantart_embed_expires', time() + 43200 );
		add_post_meta( $post_id, '_deviantart_embed', $da_response['body'] );

		$da_response_body = $da_response['body'];
	}

	// Generate client-side HTML here
	$deviation = json_decode( $da_response_body, true );
	$html      = '<figure><img src="' . $deviation['url'] . '" width="' . $deviation['thumbnail_width'] . '" height="' . $deviation['thumbnail_height'] . '" /><figcaption><strong>' . $deviation['title'] . '</strong><br />&copy; ' . $deviation['author_name'] . ' <a href="' . $deviation['author_url'] . '">View on DeviantArt</a></figcaption></figure>';

	return apply_filters( 'devart-press_deviation_embed_html', $html );
}

add_action( 'init', __NAMESPACE__ . '\register_providers' );