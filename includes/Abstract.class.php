<?php
	/**
	 * The core plugin class.
	 *
	 * This is used to define internationalization, admin-specific hooks, and
	 * public-facing site hooks.
	 *
	 * Also maintains the unique identifier of this plugin as well as the current
	 * version of the plugin.
	 *
	 * @link       https://vandijkdevelopment.nl
	 * @since      1.0.0
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/includes
	 * @author     vandijkdevelopment.nl <bas@vandijkdevelopment.nl>
	 */

	abstract class BvdWcpdfUserTemplateAbstract {

		/**
		 * The ID of this plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string $plugin_name The ID of this plugin.
		 */
		protected $plugin_name;
		protected $settings;
		/**
		 * The version of this plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string $version The current version of this plugin.
		 */
		protected $version;

		/**
		 * Initialize the class and set its properties.
		 *
		 * @param string $plugin_name The name of this plugin.
		 * @param string $version     The version of this plugin.
		 *
		 * @since    1.0.0
		 *
		 */
		public function __construct( $plugin_name, $version ) {

			$this->plugin_name = $plugin_name;
			$this->version     = $version;
			$this->settings    = get_option( 'bvd_wcpdf_user_template_settings' );
		}

		public static function get_instance() {
			global $bvd_wcpdf_user_template_plugin;

			return new static( $bvd_wcpdf_user_template_plugin->get_plugin_name(), $bvd_wcpdf_user_template_plugin->get_version() );
		}
	}