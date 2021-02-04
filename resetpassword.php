<?php
include("inc/header.php");

if($user->is_logged_in())
	header("Location: /home.php");


?>	

<body>
<center>
<div class="container">
<h1>Password Reset</h1>
<br>
<div class="well">
<?php
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzUYSADFIUJSIEE';

if(isset($_GET['token'])){
	$token = $_GET['token'];
	$resets = $mysqli_si->query("SELECT * from password_resets WHERE token = ?", [$token])->fetchAll("assoc");

	if(count($resets) <= 0)
		die("<script>alert('Invalid reset token.')</script>");
	$password = substr(str_shuffle($permitted_chars), 0, 8);
	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$update = $mysqli_si->query("UPDATE users SET password = ? WHERE id = ?", [$password_hash, $resets[0]['user_id']]);
	$delete = $mysqli_si->query("DELETE FROM password_resets WHERE token = ?", [$token]);


}
echo "<p>Your new password: <b>$password</b></p>"
?>
</div>
</div>
</body>
</html>
