<?php

class Struts_Option_Text extends Struts_Option {
	protected $_is_url;

	public function is_url( $is_url = NULL ) {
		if ( NULL === $is_url )
			return $this->_is_url;

		$this->_is_url = $is_url;
		return $this;
	}

	public function input_html() {
		$id = esc_attr( $this->html_id() );
		$name = esc_attr( $this->html_name() );
		$value = esc_attr( $this->value() );

		echo "<input type='text' id='$id' name='$name' value='$value' />";
	}

	protected function standard_validation( $value ) {
		if ( $this->is_url() ) {
			$value = esc_url_raw( $value );
		}

		return trim( $value );
	}
}