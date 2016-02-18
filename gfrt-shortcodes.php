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
		$entries = RGFormsModel::get_leads( $form_id, 0, 'ASC', '', 0, 999, null, null, false, null, null, 'active', false );

		foreach ( $entries as $entry ) {

			$single_amount = str_replace('$', '', $entry[$atts[field]]);

			$total += $single_amount;

		}
		$cs = $this->currency_symbol();

		$formatted_number = number_format_i18n( $total, 2 );

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
