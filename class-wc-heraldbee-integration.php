<?php
/**
 * WC Heraldbee
 *
 * @package Heraldbee
 */

if ( ! class_exists( 'WC_Heraldbee_Integration' ) ) :
	/**
	 * WC Heraldbee
	 *
	 * @package Heraldbee
	 */
	class WC_Heraldbee_Integration extends WC_Integration {
		/**
		 * Init and hook in the integration.
		 */
		public function __construct() {
			$this->id                 = 'heraldbee-integration';
			$this->method_title       = __( 'Heraldbee' );
			$this->method_description = __( 'Heraldbee is an application for creating Google Shopping Ads. It allows users to set up multiple Google Shopping campaigns and manage them easily. Highly automated and with a straightforward layout, Heraldbee is extremely easy to use. ' );
			// Load the settings.
			$this->init_form_fields();
			$this->init_settings();
			// Define user set variables.
			$this->woo_hb_state    = $this->get_option( 'woo_hb_state' );
			$this->consumer_key    = $this->get_option( 'consumer_key' );
			$this->consumer_secret = $this->get_option( 'consumer_secret' );
			// Actions.
			add_action( 'woocommerce_update_options_integration_' . $this->id, array( $this, 'process_admin_options' ) );
			wp_enqueue_style( 'woo_hb_sewtting_page', plugins_url( '/assets/css/style.css', __FILE__ ), null, '1.0' );
		}
		/**
		 * Define template file.
		 */
		public function admin_options() {
			$GLOBALS['hide_save_button'] = true;

			include_once 'pages/getstarted.php';
		}
	}
endif;
