<?php

namespace JesGs\DevArt;

use \League\OAuth2\Client\Token\AccessToken;

class Plugin {

	const TOKEN_OPTION_NAME = 'deviantart_access_token';

	/**
	 * @var AccessToken $access_token
	 */
	protected static AccessToken $access_token;

	/**
	 * @var Auth|null $auth
	 */
	protected static ?Auth $auth = NULL;

	/**
	 * @var Plugin|null
	 */
	static private ?Plugin $instance = null;

	public static function get_instance(): ?Plugin {
		if ( is_null( self::$instance ) ) {
			self::$instance = new Plugin();
		}

		return self::$instance;
	}

	public static function plugin_loaded(): void {

		// do auth here
		if ( ! self::$auth ) {
			self::$auth = new Auth();
		}

//		self::$auth->get_access_token();
//
//		/**
//		 * @var AccessToken $access_token
//		 */
//		$access_token = get_option( self::TOKEN_OPTION_NAME, false );

		// if access token has expired, then get new one
//		if ( ! $access_token || $access_token->hasExpired() ) {
//			self::set_access_token( self::$auth->get_access_token() );
//		} else {
//			self::set_access_token( $access_token );
//		}
//
//		$post = get_post( 2349 );
//		\JesGs\DevArt\DeviantArt\Deviation::create_journal( $post );

	}

	/**
	 * Retrieve AccessToken object
	 * @return AccessToken
	 */
	public static function get_access_token(): AccessToken {
		return self::$access_token;
	}

	public static function set_access_token( AccessToken $access_token ): void {
		self::$access_token = $access_token;

		add_option( 'deviantart_access_token', $access_token );
	}

	public function get_auth(): Auth {
		return self::$auth;
	}

	public function set_auth( Auth $auth ): void {
		self::$auth = $auth;
	}
}