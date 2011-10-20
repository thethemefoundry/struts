<?php

class Struts_Option_Image extends Struts_Option {

	public function input_html() {
		$id = $this->html_id();
		$name = $this->html_name();
		$value = $this->value();

		echo "<input type='text' id='$id' name='$name' value='$value' class='image-input' />";
		echo "<input type='button' id='{$id}_button' value='Upload' data-type='image' data-field-id='$id' class='button struts-image-upload'>";
		echo "<div id='{$id}-preview' class='image-upload-preview'>";
		if ( $value ) { echo "<img src='$value'>"; }
		echo "</div>";
	}

	protected function standard_validation( $value ) {
		return $value;
	}
}