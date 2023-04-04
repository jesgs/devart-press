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

// @todo Investigate possible PHP libraries for integrating DeviantArt with WordPress
// @todo Investigate the possibility of cross-posting blog posts to DeviantArt and vice-versa
// @todo Create an option that allows a tech savvy user to add the values to their system environment, but also add a text field in the admin for users who are not tech-savvy
require __DIR__ . '/vendor/autoload.php';

define( 'CLIENT_ID', getenv( 'CLIENT_ID' ) );
define( 'CLIENT_SECRET', getenv( 'CLIENT_SECRET' ) );

$install = \JesGs\DevArt\Install::get_instance();

register_activation_hook( __FILE__, [ $install, 'activate' ] );
register_deactivation_hook( __FILE__, [ $install, 'deactivate' ] );
