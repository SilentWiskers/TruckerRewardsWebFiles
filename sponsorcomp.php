<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isSponsor())
	header("Location: /driverhome.php");
	

if($user->getValue("sponsor_company") > 0)
	Header("Location: home.php")

?>

<div class="center">
<h1>Company Selection</h1>
<h2>Please select an existing company you wish to join</h2>
<form action="" method="POST">
<select name="sponsor">
<?php
$sponsors = $mysqli_si->query("SELECT * FROM `sponsors` WHERE approved = 1")->fetchAll("assoc");
			foreach($sponsors as $sponsor){
				$name = $sponsor['company_name'];
				$id = $sponsor['id'];
				echo "<option value='$id'>$name</option>";
			}
			
if(isset($_POST['submit_join'])){
	$sponsor_requests = $mysqli_si->query("SELECT * FROM `sponsor_join_requests` WHERE user_id = ?", [$user->uid])->fetchAll("assoc");
	if(count($sponsor_requests) >= 1)
		$message = "You already have a pending request to join a sponsor organization!";
	else{
		$sponsor = $_POST['sponsor'];
		$insert = $mysqli_si->query("INSERT INTO sponsor_join_requests (user_id, sponsor_id) VALUES (?, ?)", [$user->uid, $sponsor]);
		$message = "Request to join sponsor organization submitted!";
	}
	echo "<script>alert('$message');</script>";
}

if(isset($_POST['submit_create'])){
	$sponsor_requests = $mysqli_si->query("SELECT * FROM `sponsor_join_requests` WHERE user_id = ?", [$user->uid])->fetchAll("assoc");
	if(count($sponsor_requests) >= 1)
		$message = "You already have a pending request to join a sponsor organization!";
	else{
		$name = $_POST['company'];
		$insert = $mysqli_si->query("INSERT INTO sponsors (company_name, created_by) VALUES (?, ?)", [$name, $user->uid]);
		$update = $mysqli_si->query("UPDATE users SET sponsor_company = ? WHERE id = ?", [$insert->insertId(), $user->uid]);
		$message = "Sponsor Organization Created!";
		header("Location: home.php");
	}
	echo "<script>alert('$message');</script>";
}


?>
</select>

<button name="submit_join" class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px; margin: 48px 624px;">Submit</button>
</form>
<h3>~ OR ~</h3>
<h2>Create a new company</h2>
<form action="" method="POST">
<input name="company" placeholder="Company Name" required="" autofocus="">
<button name="submit_create" class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px; margin: 48px 624px;">Submit</button>
</form>
</div>
</body>
</html>
