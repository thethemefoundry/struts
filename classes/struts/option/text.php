<?php

class Struts_Option_Text extends Struts_Option {
	public function input_html() {
		$id = esc_attr( $this->html_id() );
		$name = esc_attr( $this->html_name() );
		$value = esc_attr( $this->value() );

		echo "<input type='text' id='$id' name='$name' value='$value' />";
	}

	protected function standard_validation( $value ) {
		return trim( $value );
	}
}