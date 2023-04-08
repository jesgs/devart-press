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

	public function enqueue_scripts() {
		// in case we need frontend assets — we just might
		wp_localize_script( 'wp-api', 'wpApiSettings', array(
			'root'  => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' )
		) );
	}

	public function load_page(): void {
		include_once __DIR__ . '/pages/options.php';
	}
}