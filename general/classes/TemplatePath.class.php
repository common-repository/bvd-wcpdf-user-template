<?php
	namespace BvdWcpdfUserTemplate\General;

	/**
	 * @link       https://vandijkdevelopment.nl
	 * @since      1.0.0
	 *
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/TemplatePath
	 * @author     vandijkdevelopment
	 */

	use BvdWcpdfUserTemplate\General;
	use BvdWcpdfUserTemplateAbstract;

	class TemplatePath extends BvdWcpdfUserTemplateAbstract {

		/**
		 * @param $filePath
		 * @param $type
		 * @param $order
		 *
		 * @return string
		 */
		public function ChosenWcpdfTemplate( $filePath, $type, $order ): string {
			$maybeIsFileName = '';

			// Early return when order ID is empty.
			if ( empty ( $order->id ) ) {
				return $filePath;
			}

			// Early return when the user Id is not found by orderId.
			if ( empty ( $userId = General\User::get_instance()->getUserIdByOrderId( $order->id ) ) ) {
				return $filePath;
			}

			// Once the option is set for the user retrieve it.
			if ( empty ( $userTemplateChoice = General\User::get_instance()->getUserTemplateChoiceByUserId( $userId ) ) ) {

				// Early return.
				return $filePath;
			}

			// Checking whether the chosen template exists within the childTheme.
			if ( ! ( $availableTemplates = General\Templates::get_instance()->getTemplatesFromChildTheme() ) ||
			     ! in_array( $userTemplateChoice, $availableTemplates ) ) {

				return $filePath;
			}

			if ( ! is_dir( $filePath ) ) {

				// Getting the file with extension. You could use the variable $type which
				// is provided as the second parameter in this function. But this does not
				// provide the extension as well. So I thought that this solution would also fit.
				$pathExploded    = explode( '/', trim( $filePath, '/' ) );
				$maybeIsFileName = ! empty ( $pathExploded ) ? end( $pathExploded ) : '';
			}

			return ( $childThemePdfPath = General\Templates::get_instance()->pathExistsInChild(
				$userTemplateChoice, $maybeIsFileName )
			) ? $childThemePdfPath : $filePath;
		}
	}