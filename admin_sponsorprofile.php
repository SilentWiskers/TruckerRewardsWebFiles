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
	<title>Driver Profile</title>
</head>
<body>
<form action ="" method="post" class="form-signin">
<div class="left">

<img src="wheezer.jpg" alt="profile pic">
<?php
//  $user_driver = new User($mysqli_si, $_GET['uid']);
$sponsor = $_SESSION['sponsor'];
//  $sponsor_profile = $mysqli_si->query("SELECT * from sponsors WHERE company_name = ? AND id = ?", [$user'sponsor_company'), $user_driver->uid])->fetch("assoc");
?>
<h5>Name: <?php echo $sponsor['company_name'];  ?></h5>
<h5>Email: <?php //echo $sponsor->email;?></h5>
<h5 class="last">Phone Number: (555)555-2275</h5>
<center>
<button name='remove' type='submit'>Remove Sponsor</button>
</form>
</center>
<?php
if(isset($_POST['remove']))
{
  //$delete = $mysqli_si->query("DELETE FROM sponsors WHERE id = ? AND company_name = ?", [$user_driver->id, $user->getValue('sponsor_company')]);
  //echo "<script>alert('Driver removed from sponsorship!');window.location.href='sponsor_driverlist.php'</script>";
}


 ?>
</div>

<div class="right">
<h2>Points:</h2>
<span class="amount"> <?php //echo $driver_sponsor_profile['points']; ?></span>


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
/*if(isset($_POST['award']))
{
  $pts = $_POST['pts'];
  $update = $mysqli_si->query("UPDATE sponsor_drivers SET points = points + ? WHERE driver_id = ? AND sponsor_company = ?", [$pts, $user_driver->uid, $user->getValue('sponsor_company')]);
  $insert = $mysqli_si->query("INSERT INTO point_log (driver_id, sponsor_id, points_awarded) VALUES (?, ?, ?)", [$user_driver->uid, $user->getValue('sponsor_company'), $pts]);
  echo "<script>alert('Driver awarded points!');window.location = window.location.href</script>";

}*/
?>
<div class="status">
<h3>Behavior Status:</h3>
<h4>Good</h4>
</div>

<h1>Recent Purchases:</h1>
<ul class="list-group">
  <li class="list-group-item">Pillow</li>
  <li class="list-group-item">Heads up digital supreme meca stereo XXD</li>
  <li class="list-group-item">Key chain</li>
  <li class="list-group-item">How to date truck girls for Dummies</li>
  <li class="list-group-item">Mother's day card</li>
</ul>
</div>
</form>
</body>
</html>
