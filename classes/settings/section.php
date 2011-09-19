<?php

class Settings_Section {
	protected $_id, $_title, $_description, $_parent_name;

	public function __construct( $id, $title, $description, $parent_name ) {
		$this->id( $id );
		$this->title( $title );
		$this->description( $description );
		$this->parent_name( $parent_name );
	}

	public function id( $id = NULL ) {
		if ( NULL === $id )
			return $this->_id;

		$this->_id = $id;
		return $this;
	}

	public function title( $title = NULL ) {
		if ( NULL === $title )
			return $this->_title;

		$this->_title = $title;
		return $this;
	}

	public function description( $description = NULL ) {
		if ( NULL === $description )
			return $this->_description;

		$this->_description = $description;
		return $this;
	}

	public function parent_name( $parent_name = NULL ) {
		if ( NULL === $parent_name )
			return $this->_parent_name;

		$this->_parent_name = $parent_name;
		return $this;
	}

	public function description_html() {
		echo "<p>{$this->description()}</p>";
	}

	public function register() {
		add_settings_section(
			$this->id(),
			$this->title(),
			array( &$this, 'description_html' ),
			$this->parent_name() );
	}
}