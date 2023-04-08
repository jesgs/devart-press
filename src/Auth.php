<?php

namespace JesGs\DevArt;
use \DeviantArt\OAuth2\Client\Provider\DeviantArt;
use \League\OAuth2\Client\Provider\GenericProvider;
use \League\OAuth2\Client\Token\AccessToken;
use \JesGs\DevArt\Interfaces\PluginComponent;

class Auth implements PluginComponent {

	const DEVIANT_ART_AUTH_URL = 'https://www.deviantart.com/oauth2/authorize';

	const DEVIANT_ART_ACCESS_TOKEN_URL = 'https://www.deviantart.com/oauth2/token';

	/**
	 * @var GenericProvider
	 */
	protected GenericProvider $provider;

	private static bool $is_user_logged_in = false;

	public function __construct() {}

	public function init(): void {
		// do Oauth cycle here
		self::do_oauth();
	}

	/**
	 * Implicit Grant start
	 * Request Auth — Step 1
	 * Redirect —> Step 2
	 *
	 * @return string
	 */
	public static function request_authorization(): string {

		$params = [
			'client_id'     => CLIENT_ID,
			'response_type' => 'token',
			'redirect_uri'  => admin_url( 'options-general.php?page=devart-press-options&authorize=true' ),
			'state'         => filter_input( INPUT_GET, 'nonce' ),
			'scope'         => 'user.manage',
		];

		return self::DEVIANT_ART_AUTH_URL . '?' . http_build_query($params);
	}

	/**
	 * Authorize — Step 2
	 * Redirected from Step 1 —> Redirect to Step 3
	 * @return string|bool
	 */
	public static function authorize(): ?string {
		$verify_nonce = filter_input( INPUT_GET, 'state' );
		if ( ! wp_verify_nonce( $verify_nonce, 'devart-press_auth' ) ) {
			return admin_url('options-general.php?page=devart-press-options?error=nonce_fail');
		}

		// are there errors?
		$error = filter_input( INPUT_GET, 'error', FILTER_SANITIZE_STRING );
		if ( ! empty( $error ) ) {
			$params = [
				'error' => $error,
				'error_description' => filter_input( INPUT_GET, 'error_description', FILTER_SANITIZE_STRING ),
			];

			$query = http_build_query( $params );
			return admin_url('options-general.php?page=devart-press-options&' . $query);
		}

		// store token in wp_options
		add_option( 'devart-press__oauth_token', 'access_token' );

		// cb#access_token=Alph4num3r1ct0k3nv4lu3&token_type=bearer&expires_in=3600&scope=basic&state=mysessionid
		$params = [
			'success' => 'true',
			'access_token' => filter_input( INPUT_GET, 'access_token' ),
			'token_type'   => filter_input( INPUT_GET, 'token_type' ),
			'expires_in'   => filter_input( INPUT_GET, 'expires_in' ),
			'scope'        => filter_input( INPUT_GET, 'scope' ),
		];
		$query = http_build_query( $params );

		return admin_url( 'options-general.php?page=devart-press-options&' . $query );
	}

	public static function do_oauth(): ?string {
		// handle auth flow
		if ( filter_input( INPUT_GET, 'request_auth', FILTER_VALIDATE_BOOLEAN ) ) {
			$deviant_art_auth_url = Auth::request_authorization();
			if ( ! empty( $deviant_art_auth_url ) ) {
				header( 'Location: ' . esc_url_raw( $deviant_art_auth_url ) );
			}
		}

		if ( filter_input( INPUT_GET, 'access_token', FILTER_SANITIZE_STRING ) ) {
			$redirect = self::authorize();
			header( 'Location: ' . $redirect );
		}

		return '';
	}
}