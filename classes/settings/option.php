<?php

abstract class Settings_Option {
	protected $_name, $_values, $_type, $_default_value, $_tab, $_section, $_label, $_description, $_page_name;

	public function name( $name = NULL ) {
		if ( NULL === $name )
			return $this->_name;

		$this->_name = $name;
		return $this;
	}

	public function values( $values = NULL ) {
		if ( NULL === $values )
			return $this->_values;

		$this->_values = $values;
		return $this;
	}

	public function type( $type = NULL ) {
		if ( NULL === $type )
			return $this->_type;

		$this->_type = $type;
		return $this;
	}

	public function default_value( $default_value = NULL ) {
		if ( NULL === $default_value )
			return $this->_default_value;

		$this->_default_value = $default_value;
		return $this;
	}

	public function page_name( $page_name = NULL ) {
		if ( NULL === $page_name )
			return $this->_page_name;

		$this->_page_name = $page_name;
		return $this;
	}

	//TODO: Other properties here

	public function register() {
		add_settings_field(
			$this->name(),
			$this->label(),
			array( &$this, 'to_html' ),
			$this->page_name(),
			$this->section() );
	}

	abstract public function to_html();
}