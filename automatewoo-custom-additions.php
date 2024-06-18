<?php
/**
 * Plugin Name: AutomateWoo Custom Additions
 * Plugin URI:
 * Description: Adds a trigger when subscription shipping addresses are updated, and a subscription shipping total rule.
 * Version: Beta
 * Author: nicw
 * Author URI:
 *
*/

namespace AutomateWoo\CustomAdditions;

use AutomateWoo\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevent direct access
}

add_filter( 'automatewoo/triggers', __NAMESPACE__ . '\\custom_triggers' );

/**
 * @param array $triggers
 * @return array
 */
function custom_triggers( $triggers ) {

	include_once plugin_dir_path( __FILE__ ) . '/includes/triggers/class-subscription-shipping-address-update.php';

	// set a unique name for the trigger and then the class name
	$triggers['Subscription shipping address update'] = 'Subscription_Shipping_Address_Update';

	return $triggers;
}