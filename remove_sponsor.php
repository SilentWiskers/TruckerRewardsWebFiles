<?php

include("inc/db.php");

$update = $mysqli_si->query("UPDATE users SET sponsor_company = 0 WHERE id = ? AND sponsor_company = ?", [$_GET['id'], $user->getValue('sponsor_company')]);

header("Location: listofsponsors.php")
?>