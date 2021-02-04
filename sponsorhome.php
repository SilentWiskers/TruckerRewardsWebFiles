<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isSponsor())
	header("Location: /driverhome.php");

if($user->getValue("sponsor_company") <= 0)
	Header("Location: sponsorcomp.php")

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">

	<link type="text/css" rel="stylesheet" href="driverhome.css">
	<title>Homepage</title>
</head>
<body>
<form action ="" method="post" class="form-signin">
<div class="left">
<?php
#Session info here
?>
<img src="company.png">
<h5>Name: <?php echo $user->getValue('first_name') . " ". $user->getValue('last_name'); ?></h5>
<h5>Email: <?php echo $user->email;?></h5>
<h5 class="last">Phone Number: <?php echo $user->getValue('phone')?></h5>

<h1>Recent Notifications:</h1>

<ul class="list-group">
	<?php
	$driver_join_requests = $mysqli_si->query("SELECT * from driver_sponsor_requests WHERE sponsor_id = ?", [$user->getValue('sponsor_company')])->fetchAll("assoc");
	$sponsor_join_requests = $mysqli_si->query("SELECT * from sponsor_join_requests WHERE sponsor_id = ?", [$user->getValue('sponsor_company')])->fetchAll("assoc");
	foreach($driver_join_requests as $request){
		$uid = $request['driver_id'];
		echo "<li>
	<a href='approve_driver_request.php?uid=$uid'>
	<img src='notified.png' style='height:50px; width:50px'>
  You have a driver requesting to join.</a>
  </li>
";
	}
	
	foreach($sponsor_join_requests as $request){
		$uid = $request['user_id'];
		echo "<li>
	<a href='approve_sponsor_request.php?uid=$uid'>
	<img src='notified.png' style='height:50px; width:50px'>
  You have a sponsor account requesting to join your organization!</a>
  </li>
";
	}?>
</ul>

</div>

<div class="right">

<h1>Top drivers with this company:</h1>
<ul class="list-group">
	<?php
	$drivers = $mysqli_si->query("SELECT * from sponsor_drivers WHERE sponsor_company = ?", [$user->getValue('sponsor_company')])->fetchAll("assoc");
	foreach($drivers as $driver){
		$user_driver = new User($mysqli_si, $driver['driver_id']);
		$first_name = $user_driver->getValue('first_name');
		$last_name = $user_driver->getValue('last_name');
	echo "<li class='list-group-item'>$first_name $last_name</li>";
	}
	?>
</ul>
<a href="sponsor_driverlist.php">
	Manage drivers
</a>

<h1>Most purchased items from your catalog:</h1>
<ul class="list-group">
</ul>
</div>
</form>
</body>
</html>
