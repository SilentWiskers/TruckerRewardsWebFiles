<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">

	<link type="text/css" rel="stylesheet" href="drivercomp.css">
	<title></title>
</head>
<body>
<div class="center">
<h1>Company Selection</h1>
<h2>Please select the sponsor company you wish to join</h2>
<form action="" method="POST">
<select name="sponsor">
<?php
$sponsors = $mysqli_si->query("SELECT * FROM `sponsors` WHERE approved = 1")->fetchAll("assoc");
			foreach($sponsors as $sponsor){
				$name = $sponsor['company_name'];
				$id = $sponsor['id'];
				echo "<option value='$id'>$name</option>";
			}
?>
</select>

<button name="submit" class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px; margin: 48px 624px;">Submit</button>
</form>
<?php

if(isset($_POST['submit'])){
	$sponsor = $_POST['sponsor'];
	$sponsor_requests = $mysqli_si->query("SELECT * FROM `driver_sponsor_requests` WHERE driver_id = ? AND sponsor_id = ?", [$_SESSION['user_id'], $sponsor])->fetchAll("assoc");
	$driver_sponsors = $mysqli_si->query("SELECT * FROM `sponsor_drivers` WHERE driver_id = ? AND sponsor_company = ?", [$_SESSION['user_id'], $sponsor])->fetchAll("assoc");
	if(count($sponsor_requests) >= 1)
		$message = "You already have a pending request to join a sponsor!";
	else if(count($driver_sponsors) >= 1)
		$message = "You are already a member of this sponsor organization!";
	else{
		$insert = $mysqli_si->query("INSERT INTO driver_sponsor_requests (driver_id, sponsor_id) VALUES (?, ?)", [$_SESSION['user_id'], $sponsor]);
		$message = "Request to join sponsor submitted!";
	}
	echo "<script>alert('$message');</script>";
}

?>
</div>
</body>
</html>