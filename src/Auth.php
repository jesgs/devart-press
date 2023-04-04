<?php

namespace JesGs\DevArt;
use \DeviantArt\OAuth2\Client\Provider\DeviantArt;
use \League\OAuth2\Client\Provider\GenericProvider;
use \League\OAuth2\Client\Token\AccessToken;

class Auth {

	/**
	 * @var GenericProvider
	 */
	protected GenericProvider $provider;

	public function get_access_token(): AccessToken {

		$provider = new GenericProvider([
			'clientId'                => CLIENT_ID,    // The client ID assigned to you by the provider
			'clientSecret'            => CLIENT_SECRET,    // The client password assigned to you by the provider
			'redirectUri'             => home_url( 'redirect' ),
			'urlAuthorize'            => 'https://www.deviantart.com/oauth2/authorize',
			'urlAccessToken'          => 'https://www.deviantart.com/oauth2/token',
			'urlResourceOwnerDetails' => 'https://service.example.com/resource'
		]);

		return $provider->getAccessToken('client_credentials');
	}
}