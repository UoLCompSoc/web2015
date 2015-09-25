<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_BATCH_USER_CREATE ();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Batch User Creation</title>
</head>

<body>
<?php
$this->load->view('include/navbar.php');
?>
