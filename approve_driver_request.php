<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isSponsor())
	header("Location: /driverhome.php");

if(!isset($_GET['uid']))
	header("Location: /sponsorhome.php");

?>

<!DOCTYPE html>
<html>
<head>
</head>
<center>
<form action="" method="post" style="border:1px solid #ccc">
  <title>Driver Request</title>
  <div class="box">
    <h1>A new driver would like to join!</h1>
    <div>
	<?php 
	$user_driver = new User($mysqli_si, $_GET['uid']);
	?>
      <br>Name: <?php echo $user_driver->getValue('first_name') . " ". $user_driver->getValue('last_name'); ?></br>
      <br>Email: <?php echo $user_driver->email;?></br>
      <br>Status: Driver status</br>
    </div>
    <h4>Will you accept this driver's application?</h4>
    <div><input type="radio" name="appchoice" value="accept"> Accept</div>
    <div><input type="radio" name="appchoice" value="reject"> Reject</div>
    <div class="clearfix">
      <button name='submit' type="submit" class="accrejbtn">Submit</button>
      <button name='return' type="submit" class="returnbtn">Return</button>
    </div>
  </form>
</center>
</html>

<?php
#Add back end here
if(isset($_POST['return']))
 header("Location: /sponsorhome.php");

if(isset($_POST['submit']) && isset($_POST['appchoice'])){
	if($_POST['appchoice'] == "accept"){
		$insert = $mysqli_si->query("INSERT INTO sponsor_drivers (sponsor_company, driver_id) VALUES (?, ?)", [$user->getValue('sponsor_company'), $user_driver->uid]);
		$delete = $mysqli_si->query("DELETE FROM driver_sponsor_requests WHERE driver_id = ? AND sponsor_id = ?", [$user_driver->uid, $user->getValue('sponsor_company')]);
		echo "<script>alert('Accepted Application');window.location.href='sponsorhome.php'</script>";
	}
	else {
		$delete = $mysqli_si->query("DELETE FROM driver_sponsor_requests WHERE driver_id = ? AND sponsor_id = ?", [$user_driver->uid, $user->getValue('sponsor_company')]);
		echo "<script>alert('Rejected Application');window.location.href='sponsorhome.php';</script>";
	}
	
}

?>
