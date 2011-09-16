<?php

abstract class Settings_Option {
	protected $_name, $_valid_values, $_value, $_type, $_default_value, $_tab, $_section, $_label, $_description, $_parent_name;

	public function name( $name = NULL ) {
		if ( NULL === $name )
			return $this->_name;

		$this->_name = $name;
		return $this;
	}

	public function valid_values( $valid_values = NULL ) {
		if ( NULL === $valid_values )
			return $this->_valid_values;

		$this->_valid_values = $valid_values;
		return $this;
	}

	public function value( $value = NULL ) {
		if ( NULL === $value )
			return $this->_value;

		$this->_value = $value;
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

	public function tab( $tab = NULL ) {
		if ( NULL === $tab )
			return $this->_tab;

		$this->_tab = $tab;
		return $this;
	}

	public function label( $label = NULL ) {
		if ( NULL === $label )
			return $this->_label;

		$this->_label = $label;
		return $this;
	}

	public function parent_name( $parent_name = NULL ) {
		if ( NULL === $parent_name )
			return $this->_parent_name;

		$this->_parent_name = $parent_name;
		return $this;
	}

	//TODO: Other properties here

	public function register() {
		add_settings_field(
			$this->name(),
			$this->label(),
			array( &$this, 'to_html' ),
			NULL,
			NULL );
	}

	abstract public function to_html();
}