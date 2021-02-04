<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isAdmin())
	header("Location: /home.php");

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>

	<link type="text/css" rel="stylesheet" href="adminhome.css">
	<title></title>
</head>
<body>
<form action ="" method="post" class="form-signin">
<div class="left">

<img src="happy.jpg" alt="profile pic">

<h5>Name: <?php echo $user->getValue('first_name') . " ". $user->getValue('last_name'); ?></h5>
<h5>User-type: Admin</h5>

<h1>Recent Notifications:</h1>

<ul class="list-group">
  <li class="list-group-item">Sponsor catalog updated</li>
  <li class="list-group-item">Sponsor appeal approved</li>
  <li class="list-group-item">New service update</li>
  <li class="list-group-item">New Sponsor created</li>
</ul>

</div>

<div class="right">


<h1>Your Members:</h1>
<ul class="list-group">
	<li class="list-group-item"><a href="admin_sponsorlist.php">Sponsor Companies</a></li>
	<li class="list-group-item"><a href="admin_userlist.php">Users</a></li>
</ul>
<div>
<a href="add_user.php">Add a user</a>
</div>

Send to <select required="">

              <option value="">Choose...</option>
              <option>Driver</option>
			  <option>Sponsor</option>
			  <option>All</option>
			  </select>

<textarea class="form-control" aria-label="With textarea">Quick memo</textarea>
</div>
</form>
</body>
</html>
