<?php

	/**
	 * The plugin bootstrap file
	 *
	 * This file is read by WordPress to generate the plugin information in the plugin
	 * admin area. This file also includes all of the dependencies used by the plugin,
	 * registers the activation and deactivation functions, and defines a function
	 * that starts the plugin.
	 *
	 * @link              https://vandijkdevelopment.nl
	 * @since             1.0.0
	 * @package           BvdWcpdfUserTemplate
	 *
	 * @wordpress-plugin
	 * Plugin Name:       WCPDF User Template
	 * Description:       Offers the possibility of changing the template being used within the plugin: WCPDF. You can change the templates that are within your child theme per user.
	 * Version:           1.0.0
	 * Author:            vandijkdevelopment
	 * Author URI:        https://vandijkdevelopment.nl
	 * License:           GPL-2.0+
	 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
	 * Text Domain:       bvd-wcpdf-user-template
	 * Domain Path:       /languages
	 */

	// If this file is called directly, abort.
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	require_once 'vendor/autoload.php';

	use BvdWcpdfUserTemplate\Activator;
	use BvdWcpdfUserTemplate\Deactivator;

	/**
	 * Currently plugin version.
	 * Start at version 1.0.0 and use SemVer - https://semver.org
	 * Rename this for your plugin and update it as you release new versions.
	 */
	define( 'BVD_WCPDF_USER_TEMPLATE_VERSION', '1.0.0' );

	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/Activator.class.php
	 */
	function activate_bvd_wcpdf_user_template() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/Activator.class.php';
		Activator::activate();
	}

	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/Deactivator.class.php
	 */
	function deactivate_bvd_wcpdf_user_template() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/Deactivator.class.php';
		Deactivator::deactivate();
	}

	register_activation_hook( __FILE__, 'activate_bvd_wcpdf_user_template' );
	register_deactivation_hook( __FILE__, 'deactivate_bvd_wcpdf_user_template' );

	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	require plugin_dir_path( __FILE__ ) . 'includes/Import.class.php';

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_bvd_wcpdf_user_template() {

		$plugin = new BvdWcpdfUserTemplate\Import();
		$plugin->run();

		return $plugin;
	}

	$bvd_wcpdf_user_template_plugin = run_bvd_wcpdf_user_template();
