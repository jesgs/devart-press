<?php

namespace JesGs\DevArt\Admin;
use JesGs\DevArt\Interfaces\PluginComponent;
use JesGs\DevArt\Auth;

class Admin implements PluginComponent {

	public function init(): void {
		add_action('admin_menu', [$this, 'admin_menu']);
		add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
	}

	public function admin_menu() {
		global $devart_press__page_hook;

		$devart_press__page_hook = add_options_page(
			__('DevArt+Press Options', 'devart-press'),
			__('DevArt+Press Options', 'devart-press'),
			'manage_options',
			'devart-press-options',
			[$this, 'load_page']
		);
	}

	public function enqueue_scripts($hook = ''): void {
		global $devart_press__page_hook;

		// in case we need frontend assets — we just might
		wp_localize_script( 'wp-api', 'wpApiSettings', array(
			'root'  => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' )
		) );

		$dep = include_once DEVART_PRESS_ABSPATH . 'assets/build/index.asset.php';
		wp_register_script(
		'devart-press--react-int',
			DEVART_PRESS_URLPATH . 'assets/build/index.js',
			$dep,
			'1.0.0'
		);

		if ( $hook === $devart_press__page_hook ) {
			wp_enqueue_script( 'devart-press--react-init' );
		}
	}

	public function load_page(): void {
		include_once __DIR__ . '/pages/options.php';
	}
}