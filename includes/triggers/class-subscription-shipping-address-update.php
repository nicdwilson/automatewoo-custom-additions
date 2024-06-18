<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access
}

use AutomateWoo\Trigger;

/**
 * This is an AutomateWoo trigger that is triggered when the customer changed a shipping address
 * on an existing subscription. It triggers on woocommerce_customer_save_address
 */
class Subscription_Shipping_Address_Update extends Trigger {

	/**
	 * Define which data items are set by this trigger, this determines which rules and actions will be available
	 *
	 * @var array
	 */
	public $supplied_data_items = array( 'customer', 'subscription' );

	/**
	 * Set up the trigger
	 */
	public function init() {
		$this->title = __( 'Subscription shipping address changed', 'automatewoo-custom' );
		$this->group = __( 'Custom Triggers', 'automatewoo-custom' );
	}

	/**
	 * Add any fields to the trigger (optional)
	 */
	public function load_fields() {}

	/**
	 * Defines when the trigger is run
	 */
	public function register_hooks() {
		add_action( 'woocommerce_customer_save_address', array( $this, 'catch_hooks' ), 5, 2 );
	}

	/**
	 * Catches the action and calls the maybe_run() method.
	 *
	 * @param $user_id
	 */
	public function catch_hooks( $user_id, $address_type ) {

		wc_get_logger()->debug('action ran', array( 'source' => '000-temp'));

		if( 'shipping' == $address_type ) {

			if ( isset( $_POST['update_all_subscriptions_addresses'] ) ) {
				$subscriptions = wcs_get_users_subscriptions( $user_id );
			} elseif ( isset( $_POST['update_subscription_address'] ) ) {
				$subscriptions = array( wcs_get_subscription( absint( $_POST['update_subscription_address'] ) ) );
			}

			if ( ! empty( $subscriptions ) ) {

				$customer = AutomateWoo\Customer_Factory::get_by_user_id( $user_id );

				foreach ( $subscriptions as $subscription ) {

					$this->maybe_run( array(
						'customer'     => $customer,
						'subscription' => $subscription,
					) );
				}
			}
		}
	}

	/**
	 * Performs any validation if required. If this method returns true the trigger will fire.
	 *
	 * @param $workflow AutomateWoo\Workflow
	 * @return bool
	 */
	public function validate_workflow( $workflow ) {

		return true;
	}

}