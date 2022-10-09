<?php
/**
 * Admin related settings in WP Backend.
 *
 * @package wordpress-slideshow
 */

namespace WP\SlideShow;

/**
 * Management of the admin settings for image upload interface.
 */
class Admin_Settings {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ), 1 );
		add_action( 'admin_init', array( $this, 'slideshow_settings_init' ) );
		add_action( 'admin_menu', array( $this, 'slideshow_options_page' ) );
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

	/**
	 * Enqueue scripts and styles for backend image functionality.
	 *
	 * @return void
	 */
	public function enqueue_admin_assets() : void {
		$plugin_name = basename( WP_SLIDESHOW_DIR );
		$plugin_dir  = WP_CONTENT_DIR . '/plugins/' . $plugin_name;

		wp_register_script(
			'admin-script',
			plugins_url( "{$plugin_name}/dist/scripts/admin.js", $plugin_dir ),
			array( 'wp-i18n', 'jquery' ),
			filemtime( WP_SLIDESHOW_DIR . '/dist/scripts/admin.js' ),
			true
		);

		wp_enqueue_script( 'admin-script' );

		wp_enqueue_style(
			'admin-styles',
			plugins_url( "{$plugin_name}/dist/styles/admin.css", $plugin_dir ),
			array(),
			filemtime( WP_SLIDESHOW_DIR . '/dist/styles/admin.css' )
		);
	}

	/**
	 * Register Slideshow Settings page in WP Admin.
	 *
	 * @return void
	 */
	public function slideshow_settings_init() : void {
		// Register a new setting for "Slideshow" page.
		register_setting( 'slideshow', 'slideshow_options', array( $this, 'handle_images_upload' ) );

		// Register a new section in the "Slideshow" page.
		add_settings_section(
			'slideshow_section',
			__( 'WP Slideshow', 'wordpress-slideshow' ),
			array( $this, 'slideshow_section_callback' ),
			'slideshow'
		);

		// Register a new field in the "slideshow_section" section, inside the "slideshow" page.
		add_settings_field(
			'slideshow_title',
			__( 'Slideshow Title', 'wordpress-slideshow' ),
			array( $this, 'slideshow_title_callback' ),
			'slideshow',
			'slideshow_section',
			array(
				'label_for' => 'slideshow_title',
				'class'     => 'slideshow_row',
			)
		);

		// Register a new field in the "slideshow_section" section, inside the "slideshow" page.
		add_settings_field(
			'slideshow_images',
			__( 'Slideshow Images', 'wordpress-slideshow' ),
			array( $this, 'slideshow_images_callback' ),
			'slideshow',
			'slideshow_section',
			array(
				'label_for' => 'slideshow_images',
				'class'     => 'slideshow_row',
			)
		);
	}

	/**
	 * Handles Image Upload.
	 *
	 * @param array $option Image Option.
	 * @return array
	 */
	public function handle_images_upload( $option ) : array {
		$slideshow_title   = filter_input( INPUT_POST, 'slideshow_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
		$slideshow_options = array();
		$image_array       = array();
		$slideshow_values  = get_option( 'slideshow_options' );
		$slideshow_images  = $slideshow_values['slideshow_images'];

		$images_to_delete = ! empty( $_POST['image_ids'] ) ? $_POST['image_ids'] : array(); // phpcs:ignore
		$files            = ! empty( $_FILES['slideshow_images'] ) ? $_FILES['slideshow_images'] : array(); // phpcs:ignore
		if ( ! empty( $images_to_delete ) && ! empty( $slideshow_images ) ) {
			foreach ( $slideshow_images as $key => $slideshow_image ) {
				if ( in_array( $slideshow_image, $images_to_delete, true ) ) {
					unset( $slideshow_images[ $key ] );
				}
			}
		}

		if ( ! empty( $slideshow_title ) ) {
			$slideshow_options['slideshow_title'] = $slideshow_title;
		}

		if ( ! empty( $files['name'] ) ) {
			foreach ( $files['name'] as $key => $value ) {
				$uploadfile = $files['tmp_name'][ $key ];
				if ( ! empty( $uploadfile ) ) {
					$file = array(
						'name'     => $files['name'][ $key ] ?? '',
						'type'     => $files['type'][ $key ] ?? '',
						'tmp_name' => $files['tmp_name'][ $key ] ?? '',
						'error'    => $files['error'][ $key ] ?? '',
						'size'     => $files['size'][ $key ] ?? '',
					);

					$urls          = wp_handle_upload( $file, array( 'test_form' => false ) );
					$image_array[] = $urls['url'];
				}
			}
		}

		$slideshow_options['slideshow_images'] = ! empty( $slideshow_images ) ? array_merge( $slideshow_images, $image_array ) : $image_array;

		return $slideshow_options;
	}

	/**
	 * Slideshow section callback method.
	 *
	 * @param array $args  The settings array, defining title, id, callback.
	 * @return void
	 */
	public function slideshow_section_callback( $args ) : void {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Configure your WP Slideshow here.', 'wordpress-slideshow' ); ?></p>
		<?php
	}

	/**
	 * Slideshow title field callback method.
	 *
	 * @param array $args  The settings array, defining title, id, callback.
	 * @return void
	 */
	public function slideshow_title_callback( $args ) : void {
		// Get the value of the setting we've registered with register_setting().
		$options = get_option( 'slideshow_options' );
		?>
		<input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?php echo esc_attr( $options['slideshow_title'] ); ?>" required />
			
		<p class="description">
			<?php esc_html_e( 'Enter a title for your slideshow.', 'wordpress-slideshow' ); ?>
		</p>
		<?php
	}

	/**
	 * Slideshow title field callback method.
	 *
	 * @param array $args  The settings array, defining title, id, callback.
	 * @return void
	 */
	public function slideshow_images_callback( $args ) : void {
		// Get the value of the setting we've registered with register_setting().
		$options = get_option( 'slideshow_options' );
		?>
		<input  accept="image/png, image/jpeg, image/jpg" type="file" multiple id="<?php echo esc_attr( $args['label_for'] ); ?>" name="<?php echo esc_attr( $args['label_for'] ); ?>[]">

		<div class="images" id="slides">
			<?php if ( ! empty( $options['slideshow_images'] ) ) : ?>
				<?php foreach ( $options['slideshow_images'] as $image ) : ?>
					<span id="image-slide">
						<img src="<?php echo esc_url( $image ); ?>" width="100" height="100" class="slides" />
						<a class="delete-image" href="javascript:void(0)"><span class="dashicons dashicons-dismiss"></span></a>
					</span>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
			
		<p class="description">
			<?php esc_html_e( 'Upload/Select multiple images for your slideshow.', 'wordpress-slideshow' ); ?>
		</p>
		<?php
	}

	/**
	 * Add the top level menu Slideshow page.
	 *
	 * @return void
	 */
	public function slideshow_options_page() : void {
		add_menu_page(
			__( 'Slideshow Configurations', 'wordpress-slideshow' ),
			__( 'WP Slideshow', 'wordpress-slideshow' ),
			'manage_options',
			'slideshow',
			array( $this, 'render_slideshow_page' )
		);
	}

	/**
	 * Top level menu callback function
	 *
	 * @return void
	 */
	public function render_slideshow_page() : void {
		// check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// check if the user have submitted the settings.
		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated".
			add_settings_error( 'slideshow_messages', 'slideshow_message', __( 'Settings Saved', 'wordpress-slideshow' ), 'updated' );
		}

		// show error/update messages.
		settings_errors( 'slideshow_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post" enctype="multipart/form-data">
				<?php
				// output security fields for the registered setting "slideshow".
				settings_fields( 'slideshow' );
				?>
				<?php
				do_settings_sections( 'slideshow' );
				// output save settings button.
				submit_button( __( 'Save Settings', 'wordpress-slideshow' ) );
				?>
			</form>
		</div>
		<?php
	}
}
