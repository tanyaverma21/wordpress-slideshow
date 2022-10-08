<?php
/**
 * Plugin Name:     WordPress Slideshow
 * Plugin URI:      https://github.com/tanyaverma21/wordpress-slideshow/
 * Description:     A plugin to showcase slideshow of uploaded images.
 * Author:          Tanya Verma
 * Author URI:      https://profiles.wordpress.org/tanyaverma/
 * Text Domain:     wordpress-slideshow
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         wordpress-slideshow
 */

namespace WP\SlideShow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WP_SLIDESHOW_DIR' ) ) {
	define( 'WP_SLIDESHOW_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
}

require_once WP_SLIDESHOW_DIR . '/vendor/autoload.php';

add_action( 'plugins_loaded', __NAMESPACE__ . '\\setup' );
