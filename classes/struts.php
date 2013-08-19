<?php

class Struts {
	static protected $_config = NULL;

	static public function load_config( array $config ) {
		self::$_config = $config;
		$locale = get_locale();
		load_textdomain( 'struts', get_template_directory() . '/includes/struts/languages/' . $locale . '.mo' );
	}

	static public function config( $name ) {
		if ( isset( self::$_config[$name] ) ) {
			return self::$_config[$name];
		} else {
			return NULL;
		}
	}
}

function struts_autoloader( $class ) {
	$filename = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . strtolower( str_replace( '_', DIRECTORY_SEPARATOR, $class ) . '.php' );

	if ( file_exists( $filename ) ) {
		require_once $filename;
	}
}

spl_autoload_register( 'struts_autoloader' );