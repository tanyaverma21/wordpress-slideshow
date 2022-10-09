<?php
/**
 * Initial Setup File for the plugin.
 *
 * @package wordpress-slideshow
 */

namespace WP\SlideShow;

use WP\SlideShow\Admin_Settings;
use WP\SlideShow\WP_Slideshow_Shortcode;

/**
 * Plugin loader.
 *
 * @return void
 */
function setup() {
	new Admin_Settings();
	new WP_Slideshow_Shortcode();
}
