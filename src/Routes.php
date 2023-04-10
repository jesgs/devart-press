<?php

namespace JesGs\DevArt;
use \JesGs\DevArt\Interfaces\PluginComponent;

class Routes implements PluginComponent {

	public function __construct() {

	}
	public function init(): void {
		add_action( 'init', [$this, 'register_routes'], 555 );
		add_action( 'rest_api_init', [ $this, 'register_rest_routes' ], 555 );
		add_action( 'template_redirect', [ $this, 'template_redirect' ], 555 );
		add_filter( 'template_include', [ $this, 'get_template' ], 555 );
	}

	public function register_routes(): void {

		// endpoint that user hits from WP Admin
		add_rewrite_endpoint( 'get-authorization', EP_ROOT, 'get_auth' );

		// endpoint for deviant-art to hit on success
		add_rewrite_endpoint( 'authorize', EP_ROOT, 'authorize' );

		// endpoint for app to retrieve token from hashed url
		add_rewrite_endpoint( 'get-token', EP_ROOT, 'get_token' );
	}

	public function register_rest_routes(): void {
		register_rest_route(
			'devart-press/v1',
			'/store-token', [
				'methods'  => 'POST',
				'callback' => [ Auth::class, 'authorize' ],
				'permission_callback' => function () {
					return Auth::is_user_logged_in();
				}
			]
		);
	}

	public function get_template( $template ): string {
		global $wp_query;

		if ( ! isset( $wp_query->query_vars['authorize'] ) ) {
			return $template;
		}

		return DEVART_PRESS_ABSPATH . '/src/templates/authorize.php';
	}

	public function template_redirect() {
		global $wp_query;

		if ( isset( $wp_query->query_vars['get_auth'] ) && is_user_logged_in() ) {
			$redirect_to_deviant_art = Auth::request_authorization();
			header( 'Location: ' . $redirect_to_deviant_art );
		}

		if ( isset( $wp_query->query_vars['authorize'] ) && is_user_logged_in() ) {
			// so do some funky shit here
		}

		if ( isset( $wp_query->query_vars['get_token'] ) ) {

		}
	}
}