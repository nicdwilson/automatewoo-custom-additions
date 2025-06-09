<?php
/**
 * Plugin Name: AutomateWoo Custom Additions
 * Plugin URI: https://github.com/nicdwilson/automatewoo-custom-additions
 * Description: Adds a trigger when subscription shipping addresses are updated, and a subscription shipping total rule.
 * Version: 1.1
 * Author: nicw
 * Author URI:
 * Requires Plugins: woocommerce, automatewoo
 *
*/

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\DataTypes\DataTypes;
use AutomateWoo\DataTypes\Gift_Card;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Custom_Additions {

	/**
	 * Menu The instance of Custom_Additions
	 *
	 * @var    object
	 * @access private
	 * @since  1.0.0
	 */
	private static object $instance;

	const GIFT_CARD          = 'gift_card';

	/**
	 * Custom_Additions Instance
	 *
	 * Ensures only one instance of Custom_Additions is loaded or can be loaded.
	 *
	 * @return  Custom_Additions instance
	 * @since  1.0.0
	 * @static
	 */
	public static function instance(): object {
		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {

		add_filter( 'automatewoo/rules/includes', array( $this, 'register_rules' ) );
		add_filter( 'automatewoo/variables', array( $this, 'register_variables' ) );
		add_filter( 'automatewoo/triggers', array( $this, 'register_triggers' ) );
	}


	/**
	 * Register rules.
	 *
	 * @param array $rules
	 *
	 * @return array
	 */
	public function register_rules( $rules ) {
		$rules['order_shipping_total'] = plugin_dir_path( __FILE__ ) . 'includes/rules/order-shipping-total-rule.php';
		$rules['subscription_shipping_total'] = plugin_dir_path( __FILE__ ) . 'includes/rules/subscription-shipping-total-rule.php';
		$rules['subscription_total'] = plugin_dir_path( __FILE__ ) . 'includes/rules/subscription-total-rule.php';
		$rules['order_billing_email'] = plugin_dir_path( __FILE__ ) . 'includes/rules/order-billing-email-rule.php';
		$rules['subscription_billing_email'] = plugin_dir_path( __FILE__ ) . 'includes/rules/subscription-billing-email-rule.php';

		return $rules;
	}

	/**
	 * Register variables.
	 *
	 * @param array $vars
	 *
	 * @return array
	 */
	public function register_variables( $vars ) {

		$vars['order']['shipping_total'] = plugin_dir_path( __FILE__ ) . 'includes/variables/order-shipping-total-variable.php';
		$vars['subscription']['shipping_total'] = plugin_dir_path( __FILE__ ) . 'includes/variables/subscription-shipping-total-variable.php';

		return $vars;
	}

	/**
	 * @param array $triggers
	 * @return array
	 */
	function register_triggers( $triggers ) {

		include_once plugin_dir_path( __FILE__ ) . '/includes/triggers/class-subscription-shipping-address-update.php';

		// set a unique name for the trigger and then the class name
		$triggers['Subscription shipping address update'] = 'Subscription_Shipping_Address_Update';

		return $triggers;
	}
}

add_action( 'plugins_loaded', array( 'AutomateWoo\CustomAdditions\Custom_Additions', 'instance' ) );