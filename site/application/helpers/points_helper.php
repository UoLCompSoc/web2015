<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
abstract class Points {

	/**
	 *
	 * @param string $nomsg
	 *        	the string to print if there aren't any bits for the registered user.
	 * @return the number of points as an int, or $nomsg if an error occurred.
	 */
	public static function get_points_for_current_user($nomsg = 'no') {
		$CI = & get_instance ();
		$pts = $CI->transaction_model->get_points_for_email ( $CI->session->userdata ( 'email' ) );
		
		return ($pts === - 1 ? $nomsg : $pts);
	}

	/**
	 *
	 * @param string $nomsg
	 *        	the string to print if there aren't any bits for the registered user.
	 */
	public static function echo_points_for_current_user($nomsg = 'no') {
		$points = Points::get_points_for_current_user ();
		
		echo ($points <= 0 ? $nomsg : $points);
	}

	/**
	 * Produces a pretty string where the string 'bits' is accompanied by a superscript helper so the user can find out more.
	 *
	 * If $bits === -1 the function will print "bit" for 1 bit, or else "bits" for multiple.
	 */
	public static function make_bits_helper($bits = -1) {
		$ret = ($bits === 1 ? 'bit' : 'bits');
		
		return $ret . '<sup><a href="/index.php/bits" title="What are bits?">[?]</a></sup>';
	}

	public static function echo_bits_helper() {
		echo Points::make_bits_helper ();
	}

	/**
	 * Produces a string of the form "x bits[?]" where x is the number of bits the user currently has.
	 */
	public static function make_pretty_points() {
		$bits = Points::get_points_for_current_user ();
		return $bits . ' ' . Points::make_bits_helper ( $bits );
	}

	public static function echo_pretty_points() {
		echo Points::make_pretty_points ();
	}
}