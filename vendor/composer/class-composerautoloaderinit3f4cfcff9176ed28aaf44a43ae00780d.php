<?php
/**
 * Autoload file.
 *
 * @package wordpress-slideshow
 */

/**
 * Require Files.
 */
// @codingStandardsIgnoreStart
class ComposerAutoloaderInit3f4cfcff9176ed28aaf44a43ae00780d {

	private static $loader;

	public static function loadClassLoader( $class ) {
		if ( 'Composer\Autoload\ClassLoader' === $class ) {
			require __DIR__ . '/class-classloader.php';
		}
	}

	public static function getLoader() {
		if ( null !== self::$loader ) {
			return self::$loader;
		}

		spl_autoload_register( array( 'ComposerAutoloaderInit3f4cfcff9176ed28aaf44a43ae00780d', 'loadClassLoader' ), true, true );
		self::$loader = $loader = new \Composer\Autoload\ClassLoader();
		spl_autoload_unregister( array( 'ComposerAutoloaderInit3f4cfcff9176ed28aaf44a43ae00780d', 'loadClassLoader' ) );

		$useStaticLoader = PHP_VERSION_ID >= 50600 && ! defined( 'HHVM_VERSION' ) && ( ! function_exists( 'zend_loader_file_encoded' ) || ! zend_loader_file_encoded() );
		if ( $useStaticLoader ) {
			require_once __DIR__ . '/class-composerstaticinit3f4cfcff9176ed28aaf44a43ae00780d.php';

			call_user_func( \Composer\Autoload\ComposerStaticInit3f4cfcff9176ed28aaf44a43ae00780d::getInitializer( $loader ) );
		} else {
			$map = require __DIR__ . '/autoload-namespaces.php';
			foreach ( $map as $namespace => $path ) {
				$loader->set( $namespace, $path );
			}

			$map = require __DIR__ . '/autoload-psr4.php';
			foreach ( $map as $namespace => $path ) {
				$loader->setPsr4( $namespace, $path );
			}

			$classMap = require __DIR__ . '/autoload-classmap.php';
			if ( $classMap ) {
				$loader->addClassMap( $classMap );
			}
		}

		$loader->register( true );

		if ( $useStaticLoader ) {
			$includeFiles = Composer\Autoload\ComposerStaticInit3f4cfcff9176ed28aaf44a43ae00780d::$files;
		} else {
			$includeFiles = require __DIR__ . '/autoload-files.php';
		}
		foreach ( $includeFiles as $fileIdentifier => $file ) {
			composerRequire3f4cfcff9176ed28aaf44a43ae00780d( $fileIdentifier, $file );
		}

		return $loader;
	}
}

function composerRequire3f4cfcff9176ed28aaf44a43ae00780d( $fileIdentifier, $file ) {
	if ( empty( $GLOBALS['__composer_autoload_files'][ $fileIdentifier ] ) ) {
		require $file;

		$GLOBALS['__composer_autoload_files'][ $fileIdentifier ] = true;
	}
}
// @codingStandardsIgnoreEnd