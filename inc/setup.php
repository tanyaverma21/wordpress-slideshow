<?php
/**
 * Initial Setup File for the plugin.
 *
 * @package wordpress-slideshow
 */

namespace WP\SlideShow;

use WP\SlideShow\Admin_Settings;

/**
 * Plugin loader.
 *
 * @return void
 */
function setup() {
	new Admin_Settings();
}
