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
		self::$is_user_logged_in = is_user_logged_in();
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
			'response_type' => 'token',
			'client_id'     => CLIENT_ID,
			'redirect_uri'  => home_url( 'authorize' ),
			'state'         => wp_create_nonce( 'devart-press_auth' ),
			'scope'         => 'user.manage',
		];

		return self::DEVIANT_ART_AUTH_URL . '?' . http_build_query($params);
	}

	/**
	 * Authorize — Step 2
	 * Redirected from Step 1 —> Auth is successful store token
	 * @return string|bool
	 */
	public static function authorize(\WP_REST_Request $request): ?\WP_REST_Response {
		$response = new \WP_REST_Response();

		// validate nonce first
		$nonce = $request->get_param( 'nonce' );
		if ( ! wp_verify_nonce($nonce, 'wp_rest') ) {
			$response->set_status(403);
			$response->set_data(['error' => 'nonce expired', 'user' => Auth::$is_user_logged_in, 'nonce' => $nonce ]);
			return $response;
		}

		$url = $request->get_param('url');
		if ( empty( $url ) ) {
			$response->set_status(422);
			$response->set_data([
				'error' => 'Missing required parameters'
			]);
		}

		$parsed_url = parse_url( $url );

		// @todo check state to make sure it matches
		// @todo add an expiration time instead of relying on the expires_in variable

		if ( ! isset( $parsed_url['fragment'] ) ) {
			$response->set_status(500);
			$response->set_data([
				'error' => 'Data could not be processed'
			]);

			return $response;
		}

		$parsed_query = [];
		$fragment = $parsed_url['fragment'];

		parse_str( $fragment, $parsed_query );

		$response->set_data([
			'message' => 'everything a-okay',
 		]);

		// store token in wp_options
		update_option( 'devart-press__oauth_token', $parsed_query );

		return $response;
	}

	public static function is_user_logged_in(): bool {
		return Auth::$is_user_logged_in;
	}
}