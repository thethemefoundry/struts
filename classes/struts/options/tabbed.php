<?php

class Struts_Options_Tabbed extends Struts_Options {
	public function __construct( $slug, $name, $menu_label = NULL, $template_file = NULL ) {
		if ( NULL === $template_file ) {
			$template_file = STRUTS_TEMPLATE_DIR . 'tabbed_sections.php';
		}

		parent::__construct( $slug, $name, $menu_label, $template_file );
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();
		wp_dequeue_style( 'struts-default' );
	}

	public function validate( $inputs ) {
		if ( isset( $_POST['struts_section'] ) ) {
			$current_section_id = $_POST['struts_section'];

			$sections = $this->sections();

			$current_section = $sections[$current_section_id];

			$existing_values = get_option( $this->name() );

			$validated_input = $existing_values;

			if ( isset( $inputs['struts_reset'] ) ) {
				foreach ( $current_section->options() as $id => $option ) {
					$validated_input[$id] = $option->default_value();
				}
			} else {
				foreach ( $current_section->options() as $id => $option ) {
					if ( isset( $inputs[$id] ) ) {
						$validated_input[$id] = $option->validate( $inputs[$id] );
					}
				}
			}
		} else {
			$validated_input = parent::validate( $inputs );
		}

		return $validated_input;
	}
}