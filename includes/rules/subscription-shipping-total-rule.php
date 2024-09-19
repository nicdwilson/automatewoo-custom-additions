<?php

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Rules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @class Subscription_Shipping_Total_Rule
 */
class Subscription_Shipping_Total_Rule extends Rules\Abstract_Number {

	public $data_item = 'subscription';

	public $support_floats = false;


	function init() {
		$this->title = __( 'Subscription - Shipping Total', 'automatewoo-custom-additions' );
	}


	/**
	 * @param $subscription \WC_Subscription
	 * @param $compare
	 * @param $value
	 * @return bool
	 */
	function validate( $subscription, $compare, $value ) {

		//get the subscription shipping total
		$shipping_total = $subscription->get_shipping_total();

		return $this->validate_number( $shipping_total, $compare, $value );
	}
}

return new Subscription_Shipping_Total_Rule();