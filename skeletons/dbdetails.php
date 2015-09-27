<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
abstract class CompSocDB {
	const DB_USERNAME = '';
	const DB_PASSWORD = '';
	const DB_NAME = '';
}

// Returns true if the database details above have been filled out, false otherwise.
// If false, you should fill out the class above with details for your local machine.
function is_db_details_valid() {
	return CompSocDB::DB_USERNAME !== "" && CompSocDB::DB_PASSWORD !== "" && CompSocDB::DB_NAME !== "";
}
