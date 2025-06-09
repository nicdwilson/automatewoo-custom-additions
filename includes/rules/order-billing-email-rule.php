<?php

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Rules\Abstract_Bool;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @class Order_Email_Rule
 * @package AutomateWoo\CustomAdditions
 */
class Order_Email_Rule extends Abstract_Bool {

	public $data_item = 'order';

	function init() {
		$this->title = __( 'Order - Billing Email Matches User Email', 'automatewoo-custom-additions' );
		$this->group = __( 'Order', 'automatewoo-custom-additions' );
	}

	/**
	 * @param \WC_Order $order
	 * @param string $compare
	 * @param string $value
	 * @return bool
	 */
	function validate( $order, $compare, $value ) {
		$billing_email = $order->get_billing_email();
		$user_id = $order->get_user_id();
		
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

return new Order_Email_Rule(); 