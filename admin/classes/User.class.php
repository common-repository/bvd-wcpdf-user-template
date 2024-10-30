<?php
	namespace BvdWcpdfUserTemplate\Admin;

	/**
	 * @link       https://vandijkdevelopment.nl
	 * @since      1.0.0
	 *
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/User
	 * @author     vandijkdevelopment
	 */

	use BvdWcpdfUserTemplate\General;
	use BvdWcpdfUserTemplateAbstract;

	class User extends BvdWcpdfUserTemplateAbstract {

		/**
		 * @param $user
		 */
		public function addPdfTemplateSelect( $user ) {
			General::include_template(
				'bvd-wcpdf-user-template-user-pdf-select',
				'admin',
				[
					'templates'    => General\Templates::get_instance()->getTemplatesFromChildTheme(),
					'userTemplate' => ! empty ( $user->ID ) && ! empty ( ( $userTemplate = General\User::get_instance()->getUserTemplateChoiceByUserId( $user->ID ) ) ) ?
						$userTemplate : '',
					'userMetaKey'  => General\User::get_instance()::USER_WCPDF_META_KEY
				]
			);
		}

		/**
		 * @param $userId
		 */
		public function savePdfTemplateSelection( $userId ) {
			$userMetaKey = General\User::get_instance()::USER_WCPDF_META_KEY;

			if ( ! current_user_can( 'edit_user', $userId ) ) {
				return;
			}

			update_user_meta(
				$userId,
				$userMetaKey,
				filter_input( INPUT_POST, $userMetaKey )
			);
		}
	}