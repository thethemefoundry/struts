<?php

class Struts_Option_Text extends Struts_Option {
	public function input_html() {
		$id = $this->html_id();
		$name = $this->html_name();
		$value = $this->value();

		echo "<input type='text' id='$id' name='$name' value='$value' />";
	}

	protected function standard_validation( $value ) {
		return trim( $value );
	}
}