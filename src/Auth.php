<?php

namespace JesGs\DevArt;
use \DeviantArt\OAuth2\Client\Provider\DeviantArt;
use \League\OAuth2\Client\Provider\GenericProvider;
use \League\OAuth2\Client\Token\AccessToken;

class Auth {

	const AUTH_URL = 'https://www.deviantart.com/oauth2/authorize';

	const ACCESS_TOKEN_URL = 'https://www.deviantart.com/oauth2/token';
	/**
	 * @var GenericProvider
	 */
	protected GenericProvider $provider;

	public function __construct() {
		add_action( 'rest_api_init', [ self::class, 'register_rest_route' ] );
	}

	public static function register_rest_route(): void {
		register_rest_route(
			'devart-press/v1',
			'/authorize',
			[
				'methods'  => 'GET',
				'callback' => [ self::class, 'authorize' ],
				'permission_callback' => function ( \WP_REST_Request $request ) {
					return current_user_can( 'edit_theme_options' );
				}
			]
		);

		register_rest_route(
			'devart-press/v1',
			'/token',
			[
				'methods'  => 'GET',
				'callback' => [ self::class, 'token' ],
				'permission_callback' => function ( \WP_REST_Request $request ) {
					return current_user_can( 'edit_theme_options' );
				}
			]
		);
	}

	public static function authorize( \WP_REST_Request $request ): \WP_REST_Response {
		// get token

		$response = new \WP_REST_Response();
		$response->set_status(200);

		$params = $request->get_params();
		$response->set_data([
			'data' => [
				'message' => 'hey ya',
				'request_parms' => $params,
			]
		]);

		return $response;

		$params = [
			'grant_type'   => 'authorization_code',
			'code'         => filter_input(INPUT_GET, 'code'),
			'redirect_uri' => 'http://' . $_SERVER['HTTP_HOST'] . '/lastfm-spotify/authorize.php',
		];

		$postdata = http_build_query($params);

		$opts = [
			'http' =>
				array(
				  'method'  => 'POST',
				  'header'  => "Content-type: application/x-www-form-urlencoded\r\n"
				               . "Authorization: Basic " . base64_encode( CLIENT_ID . ':' . CLIENT_SECRET) . "\r\n",
				  'content' => $postdata
				)
			];

		$context  = stream_context_create($opts);

		$result = @file_get_contents(self::ACCESS_TOKEN_URL, false, $context);
		$auth = json_decode($result);
		return $request;
	}

	public static function token( \WP_REST_Request $request ): \WP_REST_Response {
		$response = new \WP_REST_Response();
		return $response;
	}

	public function get_access_token()  {
		$params = [
			'response_type' => 'code',
			'client_id'     => CLIENT_ID,
			'redirect_uri'  => home_url( 'wp-json/devart-press/v1/authorize' ),
			'scope'         => 'user.manage',
		];

		$query_vars = http_build_query( $params );
		$url = self::AUTH_URL . '?' . $query_vars;
//		$response = wp_remote_get( $url );
		var_dump($url, $params);
		die();
//
//		$provider = new GenericProvider([
//			'clientId'                => CLIENT_ID,    // The client ID assigned to you by the provider
//			'clientSecret'            => CLIENT_SECRET,    // The client password assigned to you by the provider
//			'redirectUri'             => home_url( 'redirect' ),
//			'urlAuthorize'            => 'https://www.deviantart.com/oauth2/authorize',
//			'urlAccessToken'          => 'https://www.deviantart.com/oauth2/token',
//			'urlResourceOwnerDetails' => 'https://service.example.com/resource',
//			'scopes'                  => 'user.manage'
//		]);
//
//		return $provider->getAccessToken('client_credentials');
	}
}