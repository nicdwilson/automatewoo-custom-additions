<?php

class Custom_Shipping_Line_Rule extends AutomateWoo\Rules\Rule {

	/** @var string - can be string|number|object|select */
	public $type = 'string';

	/** @var string - (required) choose which data item this rule will apply to */
	public $data_item = 'subscription';

	/**
	 * Init
	 */
	function init() {
		// the title for your rule
		$this->title = __( 'Subscription total shipping cost', 'automatewoo' );

		// grouping in the admin list
		$this->group = __( 'Subscriptions', 'automatewoo' );

		// compare type is the middle select field in the rule list
		// you can define any options here but this is a basic true/false example
		$this->compare_types = [
			'is' => __( 'is', 'automatewoo' ),
			'is_not' => __( 'is not', 'automatewoo' )
		];
	}


	/**
	 * Validates the rule based on options set by a workflow
	 * The $data_item passed will already be validated
	 * @param $data_item
	 * @param $compare
	 * @param $expected_value
	 * @return bool
	 */
	function validate( $data_item, $compare, $expected_value ) {
		// because $this->data_item == 'order' $data_item will be a WC_Order object
		$subscription = $data_item;
		$actual_value = $subscription->shipping_cost;

		// we set 2 compare types
		switch ( $compare ) {
			case 'is':
				return $actual_value == $expected_value;
				break;

			case 'is_not':
				return $actual_value != $expected_value;
				break;
		}

		return false;
	}

}

return new Custom_Shipping_Line_Rule();