<?php

/**
 * Shortcodes for Gravity Forms Running Total
 */
class GFRT_Shortcodes {
	function __construct() {
		add_shortcode( 'gfrt', array( $this, 'total' ) );
	}

	/*
	Usage: [gfrt id="1" field="3"]
	*/
	function total( $atts ) {
		$form_id = 1; // Gets overwritten, but keeps PhpStorm from being angry.
		$form_id = $atts['id'];
		$total = 0;

		// From Chris Hajer April 15, 2014 to return more than 30 entries (the default)
		// Grabs all of the entries based on the $form_id
		$entries = RGFormsModel::get_leads( $form_id, 0, 'ASC', '', 0, 999, null, null, false, null, null, 'active', false );

		// loops through each form and grabs the "field" ID number based on what is submitted to the shortcode
		foreach ( $entries as $entry ) {

			// strips the $
			$single_amount = str_replace('$', '', $entry[$atts[field]]);

			// adds each value to to the total
			$total += $single_amount;

		}
		// grabs the currency symbol from WP
		$cs = $this->currency_symbol();

		// i18n'ing the number
		$formatted_number = number_format_i18n( $total, 2 );

		// appends currency symbol
		$dollar_amount = $cs.$formatted_number;

		return $dollar_amount;
	}

	function currency_symbol() {
		setlocale(LC_MONETARY, get_locale());
		$local_currency = localeconv();
		$cs = $local_currency[currency_symbol];
		return $cs;
	}
}

new GFRT_Shortcodes();
