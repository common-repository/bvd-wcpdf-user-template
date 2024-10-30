<?php

	namespace BvdWcpdfUserTemplate\General;

	/**
	 * @link       https://vandijkdevelopment.nl
	 * @since      1.0.0
	 *
	 * @package    BvdWcpdfUserTemplate
	 * @subpackage BvdWcpdfUserTemplate/User
	 * @author     vandijkdevelopment
	 */

	use BvdWcpdfUserTemplateAbstract;

	class User extends BvdWcpdfUserTemplateAbstract {

		const USER_WCPDF_META_KEY = 'wcpdf_template_choice';

		/**
		 * @param $orderId
		 *
		 * @return mixed
		 */
		public function getUserIdByOrderId( $orderId ) {
			return get_post_meta( $orderId, '_customer_user', true );
		}

		/**
		 * @param $userId
		 * @param $meta_key
		 *
		 * @return mixed
		 */
		public function getUserTemplateChoiceByUserId( $userId, $meta_key = self::USER_WCPDF_META_KEY ) {
			return get_user_meta( $userId, $meta_key, true );
		}
	}