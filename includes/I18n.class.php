<?php
	namespace BvdWcpdfUserTemplate;

	/**
	 * Define the internationalization functionality.
	 *
	 * Loads and defines the internationalization files for this plugin
	 * so that it is ready for translation.
	 *
	 * @since      1.0.0
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/includes
	 * @author     vandijkdevelopment <bas@vandijkdevelopment.nl>
	 */

	class I18n {

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since    1.0.0
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain(
				'bvd-wcpdf-user-template',
				false,
				dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
			);
		}
	}