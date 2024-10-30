<?php
	namespace BvdWcpdfUserTemplate;

	/**
	 * @link       https://vandijkdevelopment.nl
	 * @since      1.0.0
	 *
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/general
	 * @author     vandijkdevelopment <bas@vandijkdevelopment.nl>
	 */

	class General {

		/**
		 * The ID of this plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string $plugin_name The ID of this plugin.
		 */
		private $plugin_name;

		/**
		 * The version of this plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string $version The current version of this plugin.
		 */
		private $version;

		/**
		 * Initialize the class and set its properties.
		 *
		 * @param string $plugin_name The name of the plugin.
		 * @param string $version     The version of this plugin.
		 *
		 * @since    1.0.0
		 */
		public function __construct( $plugin_name, $version ) {

			$this->plugin_name = $plugin_name;
			$this->version     = $version;
		}

		public static function include_template( $template, $view = 'public', $args = array() ) {

			if ( ! empty ( $args ) && is_array( $args ) ) {
				extract( $args );
			}

			if ( strpos( $template, '.' ) === false ) {
				$template .= '.phtml';
			}

			$template_folder = plugin_dir_path( dirname( __FILE__ ) ) . $view . '/template_parts' . DIRECTORY_SEPARATOR;

			if ( file_exists( $template_folder . $template ) ) {
				include( $template_folder . $template );

				return true;
			}

			return false;
		}

		public static function printr( $content, $exit = false ) {
			print '<pre>';
			print_r( $content );
			print '</pre>';

			if ( $exit ) {
				exit;
			}
		}
	}




