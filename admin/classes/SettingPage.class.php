<?php
	namespace BvdWcpdfUserTemplate\Admin;

	/**
	 * @link       https://vandijkdevelopment.nl
	 * @since      1.0.0
	 *
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/SettingPage
	 * @author     vandijkdevelopment
	 */

	use BvdWcpdfUserTemplate\General;
	use BvdWcpdfUserTemplateAbstract;

	class SettingPage extends BvdWcpdfUserTemplateAbstract {

		public function settingsMenu() {

			add_menu_page(
				__( 'Bvd WCPDF' ),
				__( 'Bvd WCPDF' ),
				'manage_options',
				'bvd_wcpdf_user_template_settings',
				[ $this, 'settingsPage' ],
				'dashicons-text-page',
				97
			);
		}

		public function settingsPage() {
			General::include_template(
				'bvd-wcpdf-user-template-admin-options',
				'admin'
			);

			return true;
		}

		public function settingsPageSectionInfo() {}

		public function settingsRegister() {
			if ( get_option( 'bvd_wcpdf_user_template_settings' ) == false ) {
				add_option( 'bvd_wcpdf_user_template_settings' );
			}

			//add_settings_section();
			//add_settings_field();

			register_setting(
				'bvd_wcpdf_user_template_settings',
				'bvd_wcpdf_user_template_settings'
			);
		}

		public function preSettingUpdate( $value, $option_name, $old_value ) {
			return $value;
		}
	}