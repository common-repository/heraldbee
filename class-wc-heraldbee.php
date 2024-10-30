<?php
/**
 * Plugin Name: Heraldbee - the simple advertising app
 * Plugin URI: https://heraldbee.com/woocommerce-plugin/
 * Description: Heraldbee is an application for creating Google Shopping Ads. It allows users to set up multiple Google Shopping campaigns and manage them easily. Highly automated and with a straightforward layout, Heraldbee is extremely easy to use.
 * Author:  Heraldbee
 * Author URI: https://heraldbee.com
 * Version: 1.0
 *
 * Woo: 5094480:58ab9e47ecdf75b5ddc499ff10c914b7
 *
 * @package Heraldbee
 */

define( 'HB_WC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HB_WC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'HB_WC_FILE_URL', __FILE__ );
if ( ! class_exists( 'WC_heraldbee' ) ) :
	/**
	 * WC Heraldbee
	 *
	 * @package Heraldbee
	 */
	class WC_Heraldbee {
		/**
		 * Construct the plugin.
		 */
		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'init' ) );
		}
		/**
		 * Initialize the plugin.
		 */
		public function init() {
			// Checks if WooCommerce is installed.
			if ( class_exists( 'WC_Integration' ) ) {
				// Include our integration class.
				include_once 'class-wc-heraldbee-integration.php';
				// Register the integration.
				add_filter( 'woocommerce_integrations', array( $this, 'add_integration' ) );
				define( 'HERALDBEE_SLUG', 'wc-settings' );

				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'WC_heraldbee_action_links' );
				/**
				 * Add link to WC.
				 *
				 * @param string $links comment about this
				 * variable.
				 * @return links
				 */
				function WC_heraldbee_action_links( $links ) {

					$links[] = '<a href="' . menu_page_url( HERALDBEE_SLUG, false ) . '&tab=integration">Settings</a>';
					return $links;
				}
			}
		}
		/**
		 * Add integration to WC.
		 *
		 * @param array $integrations comment about this
		 * variable.
		 * @return integrations
		 */
		public function add_integration( $integrations ) {
			$integrations[] = 'WC_Heraldbee_Integration';
			return $integrations;
		}
	}
	$wc_heraldbee = new WC_heraldbee();
endif;
