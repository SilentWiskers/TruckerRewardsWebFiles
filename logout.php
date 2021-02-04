<?php
include("inc/db.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

$user->log_out();
?>
