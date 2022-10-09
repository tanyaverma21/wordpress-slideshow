<?php
/**
 * WP Slideshow shortcode file.
 *
 * @package wordpress-slideshow
 */

namespace WP\SlideShow;

/**
 * Management of the admin settings for image upload interface.
 */
class WP_Slideshow_Shortcode {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );
	}

	/**
	 * Enqueue scripts and styles for frontend slideshow functionality.
	 *
	 * @return void
	 */
	public function enqueue_styles_and_scripts() : void {
		$plugin_name = basename( WP_SLIDESHOW_DIR );
		$plugin_dir  = WP_CONTENT_DIR . '/plugins/' . $plugin_name;

		wp_register_script(
			'slideshow-script',
			plugins_url( "{$plugin_name}/dist/scripts/bundle.js", $plugin_dir ),
			array( 'wp-i18n', 'jquery' ),
			filemtime( WP_SLIDESHOW_DIR . '/dist/scripts/bundle.js' ),
			true
		);

		wp_localize_script(
			'slideshow-script',
			'ajaxload_params',
			array(
				'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
				'nonce'   => wp_create_nonce( 'ajax-load' ),
			)
		);

		wp_enqueue_script( 'slideshow-script' );

		wp_enqueue_style(
			'slideshow-styles',
			plugins_url( "{$plugin_name}/dist/styles/bundle.css", $plugin_dir ),
			array(),
			filemtime( WP_SLIDESHOW_DIR . '/dist/styles/bundle.css' )
		);
	}
}
