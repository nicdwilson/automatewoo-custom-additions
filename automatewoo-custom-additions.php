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


add_filter( 'automatewoo/triggers', 'custom_triggers' );

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

add_filter('automatewoo/rules/includes', 'custom_rules' );

/**
 * @param array $rules
 * @return array
 */
function custom_rules( $rules ) {

	$rules['custom_shipping_line_rule'] = dirname(__FILE__) . '/includes/rules/class-subscription-shipping-line-rule.php'; // absolute path to rule
	return $rules;
}

add_action( 'automatewoo_init_addons', 'load_required_files' );

function load_required_files(){
	require_once dirname( __FILE__ ) . '/includes/variables/Subscription_Renewal_Confirmation_Link.php';
	require_once dirname( __FILE__ ) . '/includes/triggers/class-membership-before-expiry.php';
}