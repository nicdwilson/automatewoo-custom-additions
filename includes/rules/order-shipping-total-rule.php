<?php

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Rules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @class Rule_Order_Shipping_Total
 */
class Order_Shipping_Total_Rule extends Rules\Abstract_Number {

	public $data_item = 'order';

	public $support_floats = false;


	function init() {
		$this->title = __( 'Order - Shipping Total', 'automatewoo-custom-additions' );
		$this->group = __( 'Order', 'automatewoo-custom-additions' );
	}


	/**
	 * @param $customer \WC_Order
	 * @param $compare
	 * @param $value
	 * @return bool
	 */
	function validate( $order, $compare, $value ) {

		//get the order shipping total
		$shipping_total = $order->get_shipping_total();

		return $this->validate_number( $shipping_total, $compare, $value );
	}
}

return new Order_Shipping_Total_Rule();