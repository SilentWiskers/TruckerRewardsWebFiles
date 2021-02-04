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
    <h1>A new sponsor account is requesting to join your sponsor organization!</h1>
    <div>
	<?php 
	$user_sponsor = new User($mysqli_si, $_GET['uid']);
	?>
      <br>Name: <?php echo $user_sponsor->getValue('first_name') . " ". $user_sponsor->getValue('last_name'); ?></br>
      <br>Email: <?php echo $user_sponsor->email;?></br>
    </div><br>
    <h4>Will you accept this user's application?</h4>
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
		$update = $mysqli_si->query("UPDATE users SET sponsor_company = ? WHERE id = ?", [$user->getValue('sponsor_company'), $user_sponsor->uid]);
		$delete = $mysqli_si->query("DELETE FROM sponsor_join_requests WHERE user_id = ? AND sponsor_id = ?", [$user_sponsor->uid, $user->getValue('sponsor_company')]);
		echo "<script>alert('Accepted Application');window.location.href='sponsorhome.php'</script>";
	}
	else {
		$delete = $mysqli_si->query("DELETE FROM sponsor_join_requests WHERE user_id = ? AND sponsor_id = ?", [$user_sponsor->uid, $user->getValue('sponsor_company')]);
		echo "<script>alert('Rejected Application');window.location.href='sponsorhome.php';</script>";
	}
	
}

?>
