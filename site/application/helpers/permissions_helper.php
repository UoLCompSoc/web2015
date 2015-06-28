<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

abstract class Permissions {
	/** the user has confirmed their email address */
	const USER_AUTHORIZED = 0x1;
	
	/** the user can update and administrate other users */
	const USER_ADMIN = 0x2;
	
	/** the user can assign, remove, and view statistics about points */
	const POINTS_ADMIN = 0x4;
	
	/** the user can create and edit portfolio items */
	const PORTFOLIO_ADMIN = 0x8;
	
	/** the user can use the batch creation system */
	const BATCH_USER_CREATE = 0x10;
	
	public static function require_logged_in() {
		if (! Permissions::is_logged_in ()) {
			get_instance()->session->set_flashdata('message', 'You need to be logged in to view that page.');
			redirect ( '/login', 'location' );
		}
	}
	
	public static function require_authorized($permissions) {
		if (! Permissions::is_authorized ( $permissions )) {
			get_instance()->session->set_flashdata('message', 'You\'re not authorized to view that page.');
			redirect ( '/', 'location' );
		}
	}
	
	public static function is_logged_in() {
		return Permissions::is_authorized ( 0x00 );
	}
	
	public static function is_authorized($permissions) {
		$CI = get_instance ();
		
		if ($CI->session->userdata('logged_in') === TRUE) {
			$granted = $CI->session->permissions;
			
			if (($granted & $permissions) === $permissions) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
}
