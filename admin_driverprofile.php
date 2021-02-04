<?php
include("inc/header.php");
/*if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isAdmin())
	header("Location: /driverhome.php");
*/
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
	<title>Driver Profile</title>
</head>
<body>
<form action ="" method="post" class="form-signin">
<div class="left">

<img src="wheezer.jpg" alt="profile pic">
<?php
  $user_driver = new User($mysqli_si, $_GET['uid']);
  $driver_sponsor_profile = $mysqli_si->query("SELECT * from sponsor_drivers WHERE driver_id = ?", [$user_driver->uid])->fetch("assoc");
?>
<h5>Name: <?php echo $user_driver->getValue('first_name') . " ". $user_driver->getValue('last_name'); ?></h5>
<h5>Email: <?php echo $user_driver->email;?></h5>
<h5 class="last">Phone Number: (555)555-2275</h5>
<center>
<a href="/admin_driver_edit.php">Edit Driver</a>
<button name='remove' type='submit'>Remove Driver</button>
</form>
</center>
<?php
if(isset($_POST['remove']))
{
  $delete = $mysqli_si->query("DELETE FROM sponsor_drivers WHERE driver_id = ? AND sponsor_company = ?", [$user_driver->uid, $user->getValue('sponsor_company')]);
  echo "<script>alert('Driver removed from sponsorship!');window.location.href='sponsor_driverlist.php'</script>";
}


 ?>
</div>

<div class="right">
<h2>Points:</h2>
<span class="amount"> <?php echo $driver_sponsor_profile['points']; ?></span>


<!--<h2 class="award">Next point award:</h2>
<span class="time">0 days; 6 hours; 32 minutes</span> -->
<form action ="" method="post">
<center>
	Award Amount:
	<input type="text" placeholder="Enter point amount" name="pts" required>
</center>
<div>
	<center>
<button name='award' type='submit'>Award Points</button>
</center>
</div>
</form>
<?php
if(isset($_POST['award']))
{
  $pts = $_POST['pts'];
  $update = $mysqli_si->query("UPDATE sponsor_drivers SET points = points + ? WHERE driver_id = ? AND sponsor_company = ?", [$pts, $user_driver->uid, $user->getValue('sponsor_company')]);
  $insert = $mysqli_si->query("INSERT INTO point_log (driver_id, sponsor_id, points_awarded) VALUES (?, ?, ?)", [$user_driver->uid, $user->getValue('sponsor_company'), $pts]);
  echo "<script>alert('Driver awarded points!');window.location = window.location.href</script>";

}
?>
</div>
</form>
</body>
</html>
