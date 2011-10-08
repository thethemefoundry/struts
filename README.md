## Struts is a simple theme options framework for WordPress.

Struts is an Options library for WordPress that aims to make setting up Theme options a breeze.

Currently Struts is under development and not recommended for use just yet - but don't worry, we're working furiously on it!

## How it will work:

* In your functions.php file, all you would need to do to setup your theme options

		<?php

		add_action( 'after_setup_theme', 'setup_your_theme_options' );

		function setup_your_theme_options() {
			require( dirname( __FILE__ ) . '/includes/struts/bootstrap.php' );

			global $your_theme_options;

			$your_theme_options = new Struts_Options( 'your_theme', 'your_theme_options' );

			$your_theme_options->add_section( 'first_section', 'Text for First Section' );
			$your_theme_options->add_section( 'second_section', 'Text for Second Section' );

			$your_theme_options->add_option( 'my_first_option', 'text', 'first_section' )
				->default_value( 'The default text' )
				->tab( 'general')
				->label( 'Enable Featured Slider' );

			$your_theme_options->add_option( 'select_this', 'select', 'second_section' )
				->valid_values( array(
					'one' => 'ONE',
					'two' => 'TWO',
					'three' => 'THREE' ) )
				->default_value( 'two' )
				->label( 'Select The Value' );

			/* More options go here... */

			$your_theme_options->initialize();
		}

		function get_your_theme_options( $option_name ) {
			global $your_theme_options;

			return $your_theme_options->option_value( $option_name );
		}

Struts aims to make options as simple as possible, so you can get setup and running quickly.

Powered by [The Theme Foundry](http://thethemefoundry.com/)