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
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>

	<link type="text/css" rel="stylesheet" href="sponsorlist.css">
	<title></title>
</head>
<body>
	<form action ="drivercomp.php" method="post" class="form-signin">
	<div class="border">
	<table>
  		<tr>
    		<th>Company Name</th>
    		<th>Points</th>
			<th>Point Value</th>
			<th>Point History</th>
			<th>Catalog</th>
  		</tr>
<?php 	

$sponsors = $mysqli_si->query("SELECT * FROM `sponsor_drivers` WHERE driver_id = ?", [$_SESSION['user_id']])->fetchAll("assoc");
foreach($sponsors as $sponsor){
	$sponsor_company = $mysqli_si->query("SELECT * FROM `sponsors` WHERE id = ?", [$sponsor['sponsor_company']])->fetch("assoc");
	$sponsor_name = $sponsor_company['company_name'];
	$points = $sponsor['points'];
	$point_value = $sponsor_company['point_value'];
	$sponsor_id = $sponsor['sponsor_company'];
	echo "  		<tr>
	<td>$sponsor_name</td>
	<td>$points pts</td>
	<td>$".$point_value."</td>
	<td><a href='/pointhistory.php?id=$sponsor_id'>Click to View</a></td>
	<td><a href='/catalog.php?id=$sponsor_id'>Click to View</a></td>
  </tr>
";


}
?>
	</table>
	
	<button name="" class="add" type="submit">Add another Sponsor</button>
	</div>
	
	</form>
</body>
</html>
