<?php

class Struts_Option_Checkbox extends Struts_Option {

	public function to_html() {
		$id = $this->html_id();
		$name = $this->html_name();
		$checked = $this->value() ? "checked='checked' " : '';

		echo "<input type='checkbox' id='$id' name='$name' value='1' $checked/>";
		echo $this->description_html();
	}

	public function value( $value = NULL ) {
		if ( NULL === $value ) {
			return (boolean) $this->_value;
		}

		$this->_value = (boolean) $value;
		return $this;
	}

	protected function standard_validation( $value ) {
		return (boolean) $value;
	}
}