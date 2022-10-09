<?php
/**
 * Autoload file.
 *
 * @package wordpress-slideshow
 */

/**
 * Require Files.
 */
$vendor_dir = dirname( dirname( __FILE__ ) );
$base_dir   = dirname( $vendor_dir );

return array(
	'WP\\SlideShow\\Admin_Settings'         => $base_dir . '/inc/class-admin-settings.php',
	'WP\\SlideShow\\WP_Slideshow_Shortcode' => $base_dir . '/inc/class-wp-slideshow-shortcode.php',
);
