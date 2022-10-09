<?php
/**
 * Autoload file.
 *
 * @package wordpress-slideshow
 */

// @codingStandardsIgnoreStart
namespace Composer\Autoload;
/**
 * Require Files.
 */
class ComposerStaticInit3f4cfcff9176ed28aaf44a43ae00780d {

	public static $files = array(
		'553066dfb3525fca8c409262f6e1d418' => __DIR__ . '/../..' . '/inc/setup.php',
	);

	public static $prefixLengthsPsr4 = array(
		'W' =>
		array(
			'WP\\SlideShow\\' => 13,
		),
		'D' =>
		array(
			'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
		),
		'B' =>
		array(
			'BjornJohansen\\WPPreCommitHook\\' => 30,
		),
	);

	public static $prefixDirsPsr4 = array(
		'WP\\SlideShow\\'                  =>
		array(
			0 => __DIR__ . '/../..' . '/inc',
		),
		'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' =>
		array(
			0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
		),
		'BjornJohansen\\WPPreCommitHook\\' =>
		array(
			0 => __DIR__ . '/..' . '/bjornjohansen/wp-pre-commit-hook/src',
		),
	);

	public static $classMap = array(
		'WP\\SlideShow\\Admin_Settings'         => __DIR__ . '/../..' . '/inc/class-admin-settings.php',
		'WP\\SlideShow\\WP_Slideshow_Shortcode' => __DIR__ . '/../..' . '/inc/class-wp-slideshow-shortcode.php',
	);

	public static function getInitializer( ClassLoader $loader ) {
		return \Closure::bind(
			function () use ( $loader ) {
				$loader->prefixLengthsPsr4 = ComposerStaticInit3f4cfcff9176ed28aaf44a43ae00780d::$prefixLengthsPsr4;
				$loader->prefixDirsPsr4    = ComposerStaticInit3f4cfcff9176ed28aaf44a43ae00780d::$prefixDirsPsr4;
				$loader->classMap          = ComposerStaticInit3f4cfcff9176ed28aaf44a43ae00780d::$classMap;

			},
			null,
			ClassLoader::class
		);
	}
}
// @codingStandardsIgnoreEnd