<?php

class Struts_Options_Tabbed extends Struts_Options {
	public function validate( $inputs ) {
		$validated_input = array();

		if ( isset( $inputs['struts_reset'] ) ) {
			$validated_input = $this->defaults();
		} else {
			$all_options = $this->all_options();

			foreach ( $all_options as $id => $option ) {
				if ( isset( $inputs[$id] ) ) {
					$validated_input[$id] = $option->validate( $inputs[$id] );
				} else {
					$validated_input[$id] = $option->value();
				}
			}
		}

		return $validated_input;
	}
}