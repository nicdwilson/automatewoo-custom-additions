<?php

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Rules\Abstract_Bool;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @class Subscription_Email_Rule
 * @package AutomateWoo\CustomAdditions
 */
class Subscription_Email_Rule extends Abstract_Bool {

	public $data_item = 'subscription';

	function init() {
		$this->title = __( 'Subscription - Billing Email Matches User Email', 'automatewoo-custom-additions' );
		$this->group = __( 'Subscription', 'automatewoo-custom-additions' );
	}

	/**
	 * @param \WC_Subscription $subscription
	 * @param string $compare
	 * @param string $value
	 * @return bool
	 */
	function validate( $subscription, $compare, $value ) {
		$billing_email = $subscription->get_billing_email();
		$user_id = $subscription->get_user_id();
		
		if ( ! $user_id ) {
			return false;
		}

		$user = get_user_by( 'id', $user_id );
		if ( ! $user ) {
			return false;
		}

		$matches = $billing_email === $user->user_email;

		switch ( $value ) {
			case 'yes':
				return $matches;
			case 'no':
				return ! $matches;
			default:
				return false;
		}
	}
}

return new Subscription_Email_Rule(); 