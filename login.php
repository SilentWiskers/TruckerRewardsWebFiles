<?php
include("inc/header.php");

if($user->is_logged_in())
	header("Location: /home.php");

?>
  <link type="text/css" rel="stylesheet" href="signin.css">
    <form action ="" method="post" class="form-signin">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  
  <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
  
  <input type="password" name="password" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
	<a href="/forgotprompt.php" style="float: right;"> Forgot Password</a>
  </div>
  <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit" style="width: 100px;margin-left: 100px;">Sign in</button>
  <p>Don't have an account? <a href="/register.php"> Make one here</a></p>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
</body>
</html>
<?php

if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$message = $user->login($email, $password);
  echo "<script>alert('$message');</script>";
  header("Location: /home.php");
  
}

?>