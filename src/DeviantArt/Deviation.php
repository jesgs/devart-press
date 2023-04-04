<?php

namespace JesGs\DevArt\DeviantArt;

class Deviation {
	const END_POINT = 'https://backend.deviantart.com/oembed?url=';

	public static function get_deviation( string $url ) {
		$oembed_url = self::END_POINT . $url;
		$results = wp_remote_get( $oembed_url );
		echo($results['body']);		die();
	}
}