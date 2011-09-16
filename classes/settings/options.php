<?php

class Settings_Options {
	protected $_options, $_page_name;

	public function __construct( $page_name ) {
		$this->options( array() );
		$this->page_name( $page_name );
	}

	public function add_option( $name, $type ) {
		$option_class = 'Settings_Option_' . ucfirst( $type );

		$option = new $option_class;
		$option->name( $name );
		$option->page_name( $this->page_name() );

		$this->_options[] = $option;
	}

	public function options( $options = NULL ) {
		if ( NULL === $options )
			return $this->_options;

		$this->_options = $options;

		return $this;
	}

	public function page_name( $page_name = NULL ) {
		if ( NULL === $page_name )
			return $this->_page_name;

		$this->_page_name = $page_name;

		return $this;
	}
}