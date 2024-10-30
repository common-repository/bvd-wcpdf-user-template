<?php
	namespace BvdWcpdfUserTemplate\General;

	/**
	 *
	 * @link       https://vandijkdevelopment.nl
	 * @since      1.0.0
	 *
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/Templates
	 * @author     vandijkdevelopment
	 */

	use BvdWcpdfUserTemplateAbstract;

	class Templates extends BvdWcpdfUserTemplateAbstract {

		/**
		 * @return array|false
		 */
		public function getTemplatesFromChildTheme() {

			if ( ! is_dir( ( $templateDir = $this->returnChildThemeTemplatePath() ) ) ) {
				return false;
			}

			if ( ! ( $templateDirectories = scandir( $templateDir ) ) ) {
				return false;
			}

			foreach( $templateDirectories as $templateKey => $templateDirectory ) {
				if ( $templateDirectory === '.' || $templateDirectory === '..' ) {
					unset( $templateDirectories[$templateKey] );

					continue;
				}
			}

			return $templateDirectories;
		}

		/**
		 * @param $folderName
		 * @param $file
		 *
		 * @return bool|string
		 */
		public function pathExistsInChild( $folderName, $file ) {
			$file = ! empty ( $file ) ? '/' . $file : '';

			return file_exists( ( $invoice = $this->returnChildThemeTemplatePath() . $folderName . $file ) ) ?
				$invoice : false;
		}

		/**
		 * @return string
		 */
		public function returnChildThemeTemplatePath() {
			return get_stylesheet_directory() . '/woocommerce/pdf/';
		}
	}