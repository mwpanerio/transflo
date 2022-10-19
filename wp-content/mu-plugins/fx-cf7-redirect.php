<?php

/**
 * Plugin Name: 	FX CF7 Redirect
 * Plugin URI: 		https://webfx.com
 * Description: 	Adds simple redirect functionality to CF7
 * Version: 		1.1.1
 * Author: 			The WebFX Team
 * Author URI: 		https://webfx.com
 */

defined( 'ABSPATH' ) || exit;

if( !class_exists( 'FX_CF7_Redirect' ) ):

	final class FX_CF7_Redirect
	{
		protected static $instance = null;

		private static $meta_key_redirect_url 	= '_fx_cf7_redirect_url';
		private static $meta_key_extra_js 		= '_fx_cf7_extra_js';
		

		public static function instance() 
		{
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}


		public function __construct() 
		{
			add_action( 'admin_notices', 			[ $this, 'install_check' ] );
			add_action( 'wpcf7_editor_panels', 		[ $this, 'add_meta_box' ] );
			add_action( 'wpcf7_after_save', 		[ $this, 'save_panel_values' ] );
			add_action( 'wp_print_footer_scripts', 	[ $this, 'add_redirection_script' ], 99 );
		}


		/**
		 * Check dependencies
		 * 
		 * This function will no longer show an error if CF7 is not installed or not active.
		 *
		 * @return	void
		 */
		public function install_check() 
		{
			$errors = new WP_Error();

			if( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
				if( !defined( 'WPCF7_VERSION' ) ) {
					$errors->add( 
						'error', 
						'Please upgrade Contact Form 7 to at least <strong>version 4.9</strong> to enable custom 
						redirects.' 
					);
				} else {
					if( 4.9 > WPCF7_VERSION ) {
						$errors->add(
							'error',
							'Your version of Contact Form 7 could not be determined and may have been corrupted. Please 
							update or reinstall Contact Form 7.'							
						);
					}
				}
			}

			if( $errors->has_errors() ) {
				foreach( $errors->get_error_messages() as $error_message ) {
					printf( '<div class="error"><p><strong>Warning:</strong> %s</p></div>', $error_message );
				}
			}
		}	


		/**
		 * Add custom admin panel to CF7 frame
		 *
		 * @param	array 	$panels 	Admin panels
		 * @return	array 				Admin panels
		 */
		public function add_meta_box( $panels ) 
		{
			if( current_user_can( 'manage_options' ) ) {
				$panels['custom-redirects'] = [
					'title'    => 'Custom Redirects',
					'callback' => [ $this, 'add_panel_fields' ],
				];
			}

			return $panels;
		}	


		/**
		 * Add fields to panel
		 * 
		 * Only users with "manage_options" WP capability will see this panel.
		 *
		 * @param	object 	$form 	CF7 form
		 * @return	void
		 */
		public function add_panel_fields( $form ) 
		{
			// grab preexisting values for display
			$form_id 		= $form->id();
			$redirect_url 	= get_post_meta( $form_id, self::$meta_key_redirect_url, true );
			$extra_js     	= get_post_meta( $form_id, self::$meta_key_extra_js, true );

			// different display options for URL validity state
			$url_is_invalid 	= false;
			$input_url_style	= '';
			$input_url_value	= '';

			// check that URL is valid URL
			if( !esc_url_raw( $redirect_url ) ) {
				$url_is_invalid = true;
				$input_url_style = 'border: 1px solid red;';
			} else {
				$input_url_value = $redirect_url;
			}

			?>

				<h3>Custom Redirect URL</h3>
				<fieldset>
					<legend>Enter URL for form to redirect to upon successful submission (i.e. <em>http://www.example.com/thank-you/</em>).</legend>
					<input 
						id="redirect_url" 
						class="large-text" 
						name="fx_cf7_redirect_url" 
						placeholder="http://www.example.com/thank-you/"
						size="70" 
						type="url" 
						style="<?php echo esc_attr( $input_url_style ); ?>"
						value="<?php echo esc_url( $input_url_value ); ?>" 
					/>

					<?php if( $url_is_invalid ): ?>
						<p style="margin-top:.25em; color:red;">Enter a full URL to redirect users after successfully completing the form.</p>
					<?php endif; ?>
				</fieldset>

				<h3 style="margin-top: 1.66em">Custom JS</h3>
				<fieldset>
					<legend>Enter any custom JS needed to run before redirect <em>(do not wrap in &lt;script&gt; tags)</em>.</legend>
					<textarea 
						id="extra_js" 
						class="large-text" 
						name="fx_cf7_extra_js" 
						placeholder="ga( 'send', 'event', 'Contact Form', 'submit' );"
						cols="100" 
						rows="4" 
					><?php echo esc_textarea( $extra_js ); ?></textarea>
				</fieldset>

			<?php
		}	


		/**
		 * Save panel values when updating form
		 *
		 * @param	object	$form 	CF7 form
		 * @return	void
		 */
		public function save_panel_values( $form )
		{
			if( !current_user_can( 'manage_options' ) ) {
				return;
			}

			$form_id 		= $form->id();
			$redirect_url   = esc_url_raw( $_REQUEST['fx_cf7_redirect_url'] );
			$extra_js       = sanitize_textarea_field( $_POST['fx_cf7_extra_js'] ?? '' );

			// update each time (in case user enters blank value to overwrite existing value)
			update_post_meta( $form_id, self::$meta_key_redirect_url, $redirect_url );
			update_post_meta( $form_id, self::$meta_key_extra_js, $extra_js );
		}


		/**
		 * Output redirection script in footer
		 *
		 * @return	void
		 */
		public function add_redirection_script()
		{
			$forms = get_posts(
				[
					'post_status'		=> 'publish',
					'post_type'			=> 'wpcf7_contact_form',
					'posts_per_page'	=> -1,
				]
			);

			$form_data = [];
			foreach( $forms as $form ) {
				$form_id 		= $form->ID;
				$redirect_url 	= get_post_meta( $form_id, self::$meta_key_redirect_url, true );
				$extra_js     	= get_post_meta( $form_id, self::$meta_key_extra_js, true );
				
				if( !empty( $redirect_url ) || !empty( $extra_js ) ) {
					$form_data[] = [
						'form_id'		=> absint( $form_id ),
						'redirect_url'	=> $redirect_url,
						'extra_js'		=> $extra_js
					];
				}
			}

			if( empty( $form_data ) ) {
				return;
			}

			?>
				<script id="fx-cf7-redirect" type="text/javascript">
					( () => {
						const allFormData = <?php echo wp_json_encode( $form_data ); ?>

						document.addEventListener( 'wpcf7mailsent', e => {
							const formData = allFormData.find( data => data.form_id === parseInt( e.detail.contactFormId ) )

							if( formData ) {
								let redirectUrl = formData.redirect_url;

								// support for FX Online Guide's download functionality
								const downloadField = e.detail.inputs.filter( field => 'downloadurl' === field.name )

								if( downloadField.length ) {
									const urlAddon = downloadField[0].value

									if( urlAddon ) {
										redirectUrl = new URL( redirectUrl )
										redirectUrl.searchParams.set( 'filefx', urlAddon )
										redirectUrl = redirectUrl.toString()
									}
								}

								if( redirectUrl ) {
									window.location = redirectUrl
								}
							}
						})
					}) ()
				</script>
			<?php
		}

	}

	function FX_CF7_Redirect() {
		return FX_CF7_Redirect::instance();
	}

	FX_CF7_Redirect();

endif;