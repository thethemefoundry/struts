<?php

abstract class Struts_Option {
	protected $_name, $_valid_values, $_value, $_type, $_default_value,
			  $_tab, $_label, $_description, $_parent_name, $_validation_function,
			  $_preview_function;

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
		if ( NULL === $value ) {
			return $this->_value;
		}

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

	public function section( $section = NULL ) {
		if ( NULL === $section )
			return $this->_section;

		$this->_section = $section;
		return $this;
	}

	public function validation_function( $validation_function = NULL ) {
		if ( NULL === $validation_function )
			return $this->_validation_function;

		$this->_validation_function = $validation_function;
		return $this;
	}

	public function preview_function( $preview_function = NULL ) {
		if ( NULL === $preview_function )
			return $this->_preview_function;

		$this->_preview_function = $preview_function;
		return $this;
	}

	// The HTML ID takes the form 'parentname-optionname'
	protected function html_id() {
		return $this->parent_name() . '-' . $this->name();
	}

	// Name takes the form 'parentname[optionname]'
	protected function html_name() {
		return $this->parent_name() . '[' . $this->name() . ']';
	}

	protected function html_input_class() {
		$pieces = explode( '_', get_class( $this ) );
		return strtolower( array_pop( $pieces ) );
	}

	public function register() {
		add_settings_field(
			$this->name(),
			$this->label(),
			array( &$this, 'to_html' ),
			$this->parent_name(),
			$this->section() );
	}

	public function register_customizer( $wp_customize, $priority ) {
		$setting_name = "{$this->parent_name()}[{$this->name()}]";

		$wp_customize->add_setting( $setting_name, array(
			'default'        => $this->default_value(),
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
		) );

		$this->add_customizer_control( $wp_customize, $setting_name, $priority );

		// If this option has a JavaScript preview_function, we want to set the transport to
		// 'postMessage' (real-time previewing) and then call the preview_function when the option is changed.
		if ( $this->preview_function() ) {
			$wp_customize->get_setting( $setting_name )->transport = 'postMessage';
			add_action( 'struts_preview_javascript', array( &$this, 'customizer_preview' ) );
		}
	}

	/**
	 * Prints some JavaScript that runs preview_function, passing the "to" variable as a parameter.
	 */
	public function customizer_preview() {
		$setting_name = "{$this->parent_name()}[{$this->name()}]";
		?>
			wp.customize('<?php echo esc_js( $setting_name ); ?>',function( value ) {
				value.bind(function(to) {
					<?php echo $this->preview_function(); ?>(to);
				});
			});
		<?php
	}

	public function validate( $value ) {
		if ( $validation_function = $this->validation_function() ) {
			return $validation_function( $value );
		} else {
			return $this->standard_validation( $value );
		}
	}

	public function to_html() {
		if ( Struts::config( 'use_struts_skin' ) ) {
			echo '<div class="' . esc_attr( 'clear struts-option ' . $this->html_input_class() ) . '">';
		}

		$this->base_html();

		if ( Struts::config( 'use_struts_skin' ) ) {
			echo "</div>";
		}
	}

	protected function base_html() {
		$this->description_html();
		if ( Struts::config( 'use_struts_skin' ) ) { $this->label_html(); }
		$this->input_html();
	}

	protected function description_html() {
		if ( $this->description() ) {
			echo "<div class='struts-option-description'>{$this->description()}</div>";
		}
	}

	protected function label_html() {
		if ( $this->label() ) {
			echo '<label class="struts-label" for="' . esc_attr( $this->html_id() ) . '">' . $this->label() . '</label>';
		}
	}

	protected function add_customizer_control( $wp_customize, $setting_name, $priority ) {
		$wp_customize->add_control( $this->name(), $this->customizer_control_options( $setting_name, $priority ) );
	}

	protected function customizer_control_options( $setting_name, $priority = 1000 ) {
		return array(
			'label' => strip_tags( $this->label() ),
			'section' => $this->section(),
			'settings' => $setting_name,
			'priority' => $priority
		);
	}

	abstract protected function input_html();
	abstract protected function standard_validation( $value );
}