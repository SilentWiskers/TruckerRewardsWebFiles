<?php

include("inc/db.php");

$delete = $mysqli_si->query("DELETE FROM catalog_item WHERE id = ? AND sponsor_id = ?", [$_GET['id'], $user->getValue('sponsor_company')]);

header("Location: sponsorcatalog.php")
?>