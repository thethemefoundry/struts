<?php

class Settings_Section {
	protected $_name, $_text, $_options;

	public function __construct( $name, $text ) {
		$this->name( $name );
		$this->text( $text );
		$this->options( array() );
	}

	public function name( $name = NULL ) {
		if ( NULL === $name )
			return $this->_name;

		$this->_name = $name;

		return $this;
	}

	public function text( $text = NULL ) {
		if ( NULL === $text )
			return $this->_text;

		$this->_text = $text;

		return $this;
	}

	public function options( $options = NULL ) {
		if ( NULL === $options )
			return $this->_options;

		$this->_options = $options;

		return $this;
	}

	public function add_option( Settings_Option $option ) {
		$this->_options[] = $option;
	}

	public function to_html() {
		$output = "<div class='section' style='border:2px solid #000'>";

		foreach ( $this->options() as $option ) {
			$output .= $option->to_html();
		}

		$output .= "</div>";

		return $output;
	}
}