<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if($user->isSponsor())
	header("Location: /home.php");
	
?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">

	<link type="text/css" rel="stylesheet" href="pointhistory.css">
	<title></title>
</head>
<body>
<center>
	<div class="well">
	<table>
  		<tr>
    		<th>Date</th>
    		<th>Points Earned</th>
  		</tr>
<?php

$points = $mysqli_si->query("SELECT * FROM `point_log` WHERE driver_id = ? AND sponsor_id = ?", [$_SESSION['user_id'], $_GET['id']])->fetchAll("assoc");
foreach($points as $point_award){
	$date = $point_award['award_time'];
	$pts = $point_award['points_awarded'];
	echo "  		<tr>
	<td class='first'>$date</td>
	<td class='last'>$pts pts</td>
  </tr>
";
}

?>
	</table>
	</div>
	</center>
</body>
</html>