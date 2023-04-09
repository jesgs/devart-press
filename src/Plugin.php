<?php

namespace JesGs\DevArt;

use JesGs\DevArt\Interfaces\PluginComponent;
use JesGs\DevArt\Admin\Admin;
use JesGs\DevArt\DeviantArt\Deviation;

class Plugin {

	/**
	 * @var Auth|null $auth
	 */
	protected static ?Auth $auth = NULL;

	/**
	 * @var Plugin|null
	 */
	static private ?Plugin $instance = null;

	/**
	 * @var PluginComponent[] $registry
	 */
	protected array $registry = [];

	public static function get_instance(): ?Plugin {
		if ( is_null( self::$instance ) ) {
			self::$instance = new Plugin();
		}

		return self::$instance;
	}

	public static function plugin_loaded( $plugin ): void {
		// prevents the classes from being loaded on every plugin load

		self::get_instance()->load_components([
			Auth::class,
			Admin::class,
			Routes::class,
			Deviation::class,
		]);
	}


	/**
	 * Load plugin components
	 *
	 * @param array $components
	 */
	public function load_components( array $components = [] ): void {

		/**
		 * @var $component
		 */
		foreach ($components as $component) {
			$comp = new $component;
			if ($comp instanceof PluginComponent) {
				$comp->init();
				$this->registry[] = $comp; // add component to registry
			}
		}
	}
}