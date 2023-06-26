<?php
/**
* Plugin Name:       DeviantArt for WordPress
* Plugin URI:        https://example.com/plugins/the-basics/
* Description:       Access the DeviantArt API for embedding artwork
* Version:           1.0.0-beta
* Requires at least: 6.2
* Requires PHP:      7.4
* Author:            Jess Green
* Author URI:        https://author.example.com/
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Update URI:        https://example.com/my-plugin/
* Text Domain:       my-basics-plugin
* Domain Path:       /languages
*/

// @todo Investigate the possibility of cross-posting blog posts to DeviantArt and vice-versa
// @todo Create an option that allows a tech savvy user to add the values to their system environment, but also add a text field in the admin for users who are not tech-savvy
require __DIR__ . '/vendor/autoload.php';

$plugin_folder = basename( dirname( __FILE__ ) );
if ( ! defined( 'DEVART_PRESS_FOLDER' ) ) {
	define( 'DEVART_PRESS_FOLDER', $plugin_folder );
}

if ( ! defined( 'DEVART_PRESS_ABSPATH' ) ) {
	define( 'DEVART_PRESS_ABSPATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'DEVART_PRESS_URLPATH' ) ) {
	define( 'DEVART_PRESS_URLPATH', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'DEVART_PRESS_LANG' ) ) {
	define('DEVART_PRESS_LANG', $plugin_folder . '/languages');
}
