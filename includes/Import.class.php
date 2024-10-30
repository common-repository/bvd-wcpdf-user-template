<?php
	namespace BvdWcpdfUserTemplate;

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
	 * @author     vandijkdevelopment <bas@vandijkdevelopment.nl>
	 */

	class Import {

		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      Loader $loader Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * The unique identifier of this plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string $plugin_name The string used to uniquely identify this plugin.
		 */
		protected $plugin_name;

		/**
		 * The current version of the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string $version The current version of the plugin.
		 */
		protected $version;

		/**
		 * Define the core functionality of the plugin.
		 *
		 * Set the plugin name and the plugin version that can be used throughout the plugin.
		 * Load the dependencies, define the locale, and set the hooks for the admin area and
		 * the public-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function __construct() {
			if ( defined( 'BVD_WCPDF_USER_TEMPLATE_VERSION' ) ) {
				$this->version = BVD_WCPDF_USER_TEMPLATE_VERSION;
			} else {
				$this->version = '1.0.0';
			}
			$this->plugin_name = 'bvd-wcpdf-user-template';

			$this->load_dependencies();

			$this->set_locale();
			$this->define_admin_hooks();
			$this->define_public_hooks();
			$this->define_general_hooks();
		}

		/**
		 * The reference to the class that orchestrates the hooks with the plugin.
		 *
		 * @return    Loader    Orchestrates the hooks of the plugin.
		 * @since     1.0.0
		 */
		public function get_loader() {
			return $this->loader;
		}

		/**
		 * The name of the plugin used to uniquely identify it within the context of
		 * WordPress and to define internationalization functionality.
		 *
		 * @return    string    The name of the plugin.
		 * @since     1.0.0
		 */
		public function get_plugin_name() {
			return $this->plugin_name;
		}

		/**
		 * Retrieve the version number of the plugin.
		 *
		 * @return    string    The version number of the plugin.
		 * @since     1.0.0
		 */
		public function get_version() {
			return $this->version;
		}

		/**
		 * Run the loader to execute all of the hooks with WordPress.
		 *
		 * @since    1.0.0
		 */
		public function run() {
			$this->loader->run();
		}

		/**
		 * Register all of the hooks related to the admin area functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_admin_hooks() {
			$plugin_admin          = new Admin( $this->get_plugin_name(), $this->get_version() );
			$plugin_admin_settings = new Admin\SettingPage( $this->get_plugin_name(), $this->get_version() );
			$plugin_admin_user     = new Admin\User( $this->get_plugin_name(), $this->get_version() );

			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueueStyles' );
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueueScripts' );

			$this->loader->add_action( 'admin_menu', $plugin_admin_settings, 'settingsMenu' );
			$this->loader->add_action( 'admin_init', $plugin_admin_settings, 'settingsRegister' );
			$this->loader->add_filter( 'pre_update_option', $plugin_admin_settings, 'preSettingUpdate', 10, 3 );

			$this->loader->add_action( 'show_user_profile', $plugin_admin_user, 'addPdfTemplateSelect', 10, 1 );
			$this->loader->add_action( 'edit_user_profile', $plugin_admin_user, 'addPdfTemplateSelect', 10, 1 );

			$this->loader->add_action( 'personal_options_update', $plugin_admin_user, 'savePdfTemplateSelection', 10, 1 );
			$this->loader->add_action( 'edit_user_profile_update', $plugin_admin_user, 'savePdfTemplateSelection', 10, 1 );
		}

		/**
		 * Register all of the hooks related to the general-facing functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_general_hooks() {
			$plugin_general_change_template_path = new General\TemplatePath( $this->get_plugin_name(), $this->get_version() );

			$this->loader->add_filter( 'wpo_wcpdf_template_file', $plugin_general_change_template_path, 'ChosenWcpdfTemplate', 10, 3 );
		}

		/**
		 * Register all of the hooks related to the public-facing functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_public_hooks() {
		}

		/**
		 * Load the required dependencies for this plugin.
		 *
		 * Include the following files that make up the plugin:
		 *
		 * - Loader. Orchestrates the hooks of the plugin.
		 * - I18n. Defines internationalization functionality.
		 *
		 * - Admin. Defines all hooks for the admin area.
		 * - Public. Defines all hooks for the public side of the site.
		 *
		 * Create an instance of the loader which will be used to register the hooks
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function load_dependencies() {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/Abstract.class.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/Loader.class.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/I18n.class.php';

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/Admin.class.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/classes/SettingPage.class.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/classes/User.class.php';

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'general/General.class.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'general/classes/TemplatePath.class.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'general/classes/User.class.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'general/classes/Templates.class.php';

			$this->loader = new Loader();
		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * Uses the I18n class in order to set the domain and to register the hook
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function set_locale() {
			$plugin_i18n = new I18n();

			$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
		}
	}
