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

	<link type="text/css" rel="stylesheet" href="driverhome.css">
	<title>Homepage</title>
</head>
<body>
<form action ="" method="post" class="form-signin">
<div class="left">

<img src="happy.jpg" alt="profile pic">

<h5>Name: <?php echo $user->getValue('first_name') . " ". $user->getValue('last_name'); ?></h5>
<h5>Email: <?php echo $user->email;?></h5>
<h5 class="last">Phone Number:  <?php echo $user->getValue('phone')?></h5>

<h1>Recent Notifications:</h1>

<ul class="list-group">
<li class="list-group-item">Welcome to the driver app!</li>

</ul>

</div>

<div class="right">
<h2>Last point award amount:</h2>
<span class="amount"> 0 pts </span>

<div class="status">
<h3>Behavior Status:</h3>
<h4>Good</h4>
</div>

<h1>Recent Purchases:</h1>
<ul class="list-group">
<?php
$purchases = $mysqli_si->query("SELECT * from purchases WHERE driver_id = ?", [$user->uid])->fetchAll("assoc");

foreach($purchases as $purchase){
  $item = $mysqli_si->query("SELECT * from catalog_item WHERE id = ?", [$purchase['item_id']])->fetch("assoc");
  $item_name = $item['item_name'];
  echo "<li class='list-group-item'>$item_name</li>";
    }
?>
</ul>
</div>
</form>
</body>
</html>
