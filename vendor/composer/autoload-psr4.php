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
	'WP\\SlideShow\\'                  => array( $base_dir . '/inc' ),
	'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => array( $vendor_dir . '/dealerdirect/phpcodesniffer-composer-installer/src' ),
	'BjornJohansen\\WPPreCommitHook\\' => array( $vendor_dir . '/bjornjohansen/wp-pre-commit-hook/src' ),
);
