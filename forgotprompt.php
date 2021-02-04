<?php
include("inc/header.php");

if($user->is_logged_in())
	header("Location: /home.php");


?>
<body>
	<div class="container">
	<center>

	<form action ="" method="post" class="form-signin">
	
	<div class="main">
	<h2>Please provide the email on file</h2>
	<input type="text" class="form-control" name="email" id="basic-url" aria-describedby="basic-addon3" Placeholder="Type Email" style="height: 31px;width: 50%;margin: 21px 251px;">	
	<button name="submit" class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px;margin: 0px 450px;">Submit</button>
	</div>
	
	</form>
	</center>
	</div>
</body>
</html>
<?php
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
if(isset($_POST['submit'])){

	$email = $_POST['email'];
	$user_ = $mysqli_si->query("SELECT * from users WHERE email = ?", [$email])->fetchAll("assoc");
	if(count($user_) <= 0)
		die("<script>alert('No user with this email.')</script>");

	$token = substr(str_shuffle($permitted_chars), 0, 15);
	$insert = $mysqli_si->query("INSERT INTO password_resets (user_id, token) VALUES (?, ?)", [$user_[0]['id'], $token]);
	$url = "http://4910.cj.gy/resetpassword.php?token=$token";
	mail($email,"Password Reset", "Please visit this URL to reset your password: $url");
	echo "<script>alert('Please check your email for a password reset link!')</script>";
	echo "Please visit this URL to reset your password: $url";
}
?>
