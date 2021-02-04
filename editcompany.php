<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isAdmin())
	header("Location: /home.php");

if(!isset($_GET['id']))
	header("Location: /home.php");

	if(isset($_POST['submit'])){
		$update = $mysqli_si->query("UPDATE sponsors SET company_name = ? , point_value = ? WHERE id = ?", [$_POST['company'], $_POST['point'], $_GET['id']]);
	
	
	}
	
	
$sponsors = $mysqli_si->query("SELECT * from sponsors WHERE id = ?", [$_GET['id']])->fetchAll("assoc");

if(count($sponsors) <= 0)
	header("Location: /home.php");
$sponsor = $sponsors[0];
?>

<body>
<center>
<form action ="" method="post" class="form-signin">
<div class="center">
<h1>Edit Company</h1>
<h2>Change Company Name</h2>
<input name="company" placeholder="Company Name" required="" autofocus="" value="<?php echo $sponsor['company_name'];?>">

<h2>Change Company Point Value</h2>

<input name="point" placeholder="0.01" required="" autofocus="" value="<?php echo $sponsor['point_value'];?>">
<center><button name="submit" class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px; margin: 48px 624px;">Submit</button></center>
</div>
</form>
</body>
</html>
