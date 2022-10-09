<?php
/**
 * WP Slideshow shortcode file.
 *
 * @package wordpress-slideshow
 */

namespace WP\SlideShow;

/**
 * Management of the [wp_slideshow] shortcode.
 */
class WP_Slideshow_Shortcode {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );
		add_shortcode( 'wp_slideshow', array( $this, 'wp_slideshow_shortcode' ) );
	}

	/**
	 * Enqueue scripts and styles for frontend slideshow functionality.
	 *
	 * @return void
	 */
	public function enqueue_styles_and_scripts() : void {
		$plugin_name = basename( WP_SLIDESHOW_DIR );
		$plugin_dir  = WP_CONTENT_DIR . '/plugins/' . $plugin_name;

		wp_enqueue_script(
			'slideshow-script',
			plugins_url( "{$plugin_name}/dist/scripts/bundle.js", $plugin_dir ),
			array( 'wp-i18n', 'jquery', 'slick-script' ),
			filemtime( WP_SLIDESHOW_DIR . '/dist/scripts/bundle.js' ),
			true
		);

		wp_enqueue_style(
			'slideshow-styles',
			plugins_url( "{$plugin_name}/dist/styles/bundle.css", $plugin_dir ),
			array(),
			filemtime( WP_SLIDESHOW_DIR . '/dist/styles/bundle.css' )
		);

		wp_enqueue_script(
			'slick-script',
			plugins_url( "{$plugin_name}/lib/slick/slick.js", $plugin_dir ),
			array( 'wp-i18n', 'jquery' ),
			filemtime( WP_SLIDESHOW_DIR . '/lib/slick/slick.js' ),
			true
		);

		wp_enqueue_style(
			'slick-styles',
			plugins_url( "{$plugin_name}/lib/slick/slick.css", $plugin_dir ),
			array(),
			filemtime( WP_SLIDESHOW_DIR . '/lib/slick/slick.css' )
		);
	}

	/**
	 * Registers shortcode [wp_slideshow].
	 *
	 * @return string
	 */
	public function wp_slideshow_shortcode() : string {
		$slideshow_options = get_option( 'slideshow_options' );
		$slideshow_title   = ! empty( $slideshow_options['slideshow_title'] ) ? $slideshow_options['slideshow_title'] : __( 'WP Slideshow', 'wordpress-slideshow' );
		$slideshow_images  = ! empty( $slideshow_options['slideshow_images'] ) ? $slideshow_options['slideshow_images'] : array();
		$html              = '';
		ob_start(); ?>
		<div class="slideshow-wrapper">
			<h2><?php echo esc_html( $slideshow_title ); ?></h2>
			<div class="slideshow">
			<?php
			if ( ! empty( $slideshow_images ) ) {
				foreach ( $slideshow_images as $slideshow_image ) {
					?>
						<img src="<?php echo esc_url( $slideshow_image ); ?>" />
											 <?php
				}
			}
			?>
			</div>
		</div>
		<?php

		$html = ob_get_clean();
		return $html;
	}
}
