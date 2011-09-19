## Easy WordPress Theme Options

The goal of this library is to abstract away as much of the WordPress settings API as possible, and make setting up options a breeze!

## Setup

* Clone this repository
* Symlink the 'classes' folder from this library into your functions folder in your theme
* In your functions.php file, use this code to setup your theme's options:

	<?php
	
	add_action( 'after_setup_theme', 'react_options' );
	
	function react_options() {
		require( dirname( __FILE__ ) . '/functions/settings/settings.php' );
		
		global $react_options;
		
		$react_options = new Settings_Collection( 'react', 'theme_react_options' );
		
		$react_options->add_section( 'first_section', 'Text for First Section' );
		$react_options->add_section( 'second_section', 'Text for Second Section' );
		
		$react_options->add_option( 'my_first_option', 'text', 'first_section' )
			->default_value( 'The default text' )
			->tab( 'general')
			->label( 'Enable Featured Slider' );
			
		$react_options->add_option( 'select_this', 'select', 'second_section' )
			->valid_values( array(
				'one' => 'ONE',
				'two' => 'TWO',
				'three' => 'THREE' ) )
			->default_value( 'two' )
			->label( 'Select Your Character' );
			
		/* More options go here... */
		
		$react_options->initialize();
	}

Bam! You have theme options!