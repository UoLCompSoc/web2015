<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class CompSocEncryption {
	const ENCRYPTION_KEY = '';
}

// Returns true if the encryption details above have been filled out, false otherwise.
// If false, you should fill out the class above with a secure encryption key.
function is_encryption_details_valid() {
	return CompSocEncryption::ENCRYPTION_KEY !== '';
}

