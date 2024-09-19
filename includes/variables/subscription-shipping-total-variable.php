<?php

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Variable_Abstract_Price;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Subscription_Shipping_Total_Variable
 *
 * @package AutomateWoo\CustomAdditions
 */
class Subscription_Shipping_Total_Variable extends Variable_Abstract_Price {

	/**
	 * Load admin details
	 */
	public function load_admin_details() {

		parent::load_admin_details();

		$this->description = __( "Shows the subscription shipping total", 'automatewoo-custom-additions' );
	}

	/**
	 * Get variable value.
	 *
	 * @param \WC_Subscription $subscription
	 * @param array $parameters
	 *
	 * @return string|bool
	 */
	public function get_value( $subscription, $parameters ) {

		return parent::format_amount( $subscription->get_shipping_total(), $parameters );
	}
}

return new Subscription_Shipping_Total_Variable();
