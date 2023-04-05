<?php

namespace JesGs\DevArt\DeviantArt;

use \JesGs\DevArt\Plugin;
use JetBrains\PhpStorm\NoReturn;

class Deviation {

	const JOURNAL_CREATE = 'https://www.deviantart.com/api/v1/oauth2/deviation/journal/create';

	public static function get_deviation( string $url ) {}

	/**
	 * Post contents of WordPress article to DeviantArt and store the response (UUID) as post meta
	 * Add post tags to response as tags for DeviantArt journal
	 *
	 * @param \WP_Post $post
	 *
	 * @return void
	 */
	public static function create_journal( \WP_Post $post ): void {

		die();
		$access_token_obj = Plugin::get_access_token();

		$access_token = $access_token_obj->getToken();

		// build our POST object
		$journal_data = [
			'access_token'    => $access_token,
			'title'           => $post->post_title,
			'body'            => $post->post_content,
			'tags'            => '',
			'is_mature'       => false,
			'allow_comments'  => true,
			'license_options' => [],
		];

		$response = wp_remote_post( self::JOURNAL_CREATE, [
			'body' => $journal_data,
		] );
		var_dump($response);
//		if ( 200 === $response['code'] ) {
//			add_post_meta( $post->ID, 'deviantion_uuid', $response['body']['deviationid'] );
//		}
		die();
	}
}