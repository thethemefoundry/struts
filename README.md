## Struts is a simple theme options framework for WordPress.

Struts is an Options library for WordPress that aims to make setting up Theme options a breeze.

## How it works:

* In your functions.php file, all you need to do to setup your theme options

		<?php
		function mytheme_options_init() {
			locate_template( array( 'path/to/struts/classes/struts.php' ), true );

			Struts::load_config( array(
				'struts_root_uri' => get_template_directory_uri() . '/path/to/struts', // required, set this to the URI of the root Struts directory
				'use_struts_skin' => true, // optional, overrides the Settings API html output
			) );

			global $mytheme_options;

			$mytheme_options = new Struts_Options( 'mytheme', 'theme_mytheme_options' );

			// Setup the option sections
			$mytheme_options->add_section( 'section_one', __( 'Section One', 'mytheme' ), 200 ); // 200 is priority of section in the customizer
			$mytheme_options->add_section( 'section_two', __( 'Section Two', 'mytheme' ), 201 );

			/* Section One
			 * ------------------------------------------------------------------ */

			$mytheme_options->add_option( 'option_one', 'image', 'section_one' )
				->default_value( '' )
				->label( __( 'Image option:', 'mytheme' ) )
				->description( __( 'Upload an image (making sure to click <strong>"Insert into post"</strong>) or enter an <abbr title="Universal resource locator">URL</abbr> for your image.', 'mytheme' ) );

			$mytheme_options->add_option( 'option_two', 'select', 'section_one' )
				->valid_values( array(
					'first_value' => __( 'First Value', 'mytheme' ),
					'second_value' => __( 'Second Value', 'mytheme' ) ) )
				->default_value( 'first_value' )
				->label( __( 'Select option:', 'mytheme' ) )
				->description( __( 'Select an option from the select dropdown.', 'mytheme' ) );

			/* Section Two
			 * ------------------------------------------------------------------ */

			$mytheme_options->add_option( 'option_three', 'checkbox', 'section_two' )
				->default_value( false )
				->label( __( 'Checkbox option', 'mytheme' ) )
				->description( __( 'A checkbox option.', 'mytheme' ) );

			$mytheme_options->add_option( 'option_four', 'text', 'section_two' )
				->label( __( 'A text option:', 'mytheme' ) )
				->description( __( 'A text input.', 'mytheme' ) );
		}

		add_action( 'after_setup_theme', 'mytheme_options_init', 5 );

		// Gets the value for a requested option.
		function mytheme_option( $option_name ) {
			global $mytheme_options;

			return $mytheme_options->get_value( $option_name );
		}

Struts makes options as simple as possible, so you can get setup and running quickly.

Powered by [The Theme Foundry](http://thethemefoundry.com/)