<?php

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Rules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @class Subscription_Total_Rule
 */
class Subscription_Total_Rule extends Rules\Abstract_Number {

	public $data_item = 'subscription';

	public $support_floats = false;


	function init() {
		$this->title = __( 'Subscription - Total', 'automatewoo-custom-additions' );
	}


	/**
	 * @param $subscription \WC_Subscription
	 * @param $compare
	 * @param $value
	 * @return bool
	 */
	function validate( $subscription, $compare, $value ) {

		//get the subscription shipping total
		$subscription_total = $subscription->get_total();

		return $this->validate_number( $subscription_total, $compare, $value );
	}
}

return new Subscription_Total_Rule();