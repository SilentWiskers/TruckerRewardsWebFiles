<?php
include("inc/db.php");

if(!$user->is_logged_in())
	header("Location: /login.php");

else if($user->isDriver())
	header("Location: /driverhome.php");

else if($user->isSponsor())
	header("Location: /sponsorhome.php");

else if($user->isAdmin())
	header("Location: /adminhome.php")

?>
