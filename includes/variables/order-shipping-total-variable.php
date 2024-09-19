<?php

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Variable_Abstract_Price;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Order_Shipping_Total_Variable
 *
 * @package AutomateWoo\Birthdays
 */
class Order_Shipping_Total_Variable extends Variable_Abstract_Price {

	/**
	 * Load admin details
	 */
	public function load_admin_details() {

		parent::load_admin_details();

		$this->description = __( "Shows the order shipping total", 'automatewoo-custom-additions' ) . ' ' . $this->_desc_format_tip;
	}

	/**
	 * Get variable value.
	 *
	 * @param \AutomateWoo\Order $order
	 * @param array $parameters
	 *
	 * @return string|bool
	 */
	public function get_value( $order, $parameters ) {

		return parent::format_amount( $order->get_shipping_total(), $parameters );
	}
}

return new Order_Shipping_Total_Variable();
