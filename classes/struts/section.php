<?php

class Struts_Section {
	protected $_id, $_title, $_description, $_parent_name, $_options;

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

		foreach ( $this->options() as $option ) {
			$option->register();
		}
	}

	public function options( $options = NULL ) {
		if ( NULL === $options )
			return $this->_options;

		$this->_options = $options;

		return $this;
	}

	public function add_option( Struts_Option $option ) {
		$this->_options[$option->name()] = $option;
	}

	public function to_html() {
		echo "<div class='struts-section'>";
		echo "<h3>{$this->title()} <a href='#'>" . __( 'Edit' ) . '</a></h3>';
		echo "<div class='struts-section-body clear'>";
		foreach ( $this->options() as $option ) {
			$option->to_html();
		}

		echo '<div class="struts-save-button submit">';
		echo '<input type="submit" class="button-primary struts-save-button" value="' . __( 'Save changes' ) . '" />';

		echo "</div></div></div>";

	}
}