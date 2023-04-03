<?php

namespace JesGs\DevArt;

class Install {

	/**
	 * Instance of class
	 * @var Install|null
	 */
	static private ?Install $instance = null;

	/**
	 * Retrieve instance of class
	 * @return Install|null
	 */
	public static function get_instance(): ?Install {
		if ( is_null( self::$instance ) ) {
			self::$instance = new Install();
		}

		return self::$instance;
	}

	public function activate() {

	}

	public function deactivate() {

	}
}