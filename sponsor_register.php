<?php
include("inc/header.php");
?>
<div class="container">
<center>
<form action="" method="post" style="border:1px solid #ccc">
  <div class="box">
    <h1>New User?</h1>
    <p>Create an account by filling the form below. (*Required)</p>
    <hr>
    <div>
    		<label for="first_name"><b>*First Name</b></label>
    		<input type="text" placeholder="First Name" name="fName" required>

    		<label for="last_name"><b>*Last Name</b></label>
    		<input type="text" placeholder="Last Name" name="lName" required>
    </div>

    <div>
    		<label for="address"><b>Address</b></label>
    		<input type="text" placeholder="Enter Address" name="address">

    		<label for="phone"><b>*Phone Number</b></label>
    		<input type="number" placeholder="Phone Number" name="phone" required>
    </div>

<div>
    <label for="email"><b>*Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>*Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
</div>

    <div class="clearfix">
      <button name='submit' type="submit" class="signupbtn">Sign Up</button>
    </div>

    <div>
      <p>Are you a driver? Create a driver account
        <a href="register.php"> here.</a>
      </p>
    </div>

    <div>
      <p>Already have an account? Log in to your page
        <a href="login.php"> here.</a>
      </p>
    </div>

  </div>
</form>
</center>
</div>
<?php

if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$message = $user->register($email, $_POST['password'], $_POST['fName'], $_POST['lName'], $_POST['address'], $_POST['phone'], 1);
	echo "<script>alert('$message');window.location.replace('/login.php');</script>";
}




?>
