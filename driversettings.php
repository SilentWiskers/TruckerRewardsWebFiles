<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if($user->isSponsor())
	header("Location: /home.php");

    if(isset($_POST['update'])){
        if(isset($_POST['2fa']))
            $fa = 1;
        else
            $fa = 0;
		$update = $mysqli_si->query("UPDATE users SET first_name = ? , last_name = ?, email = ?, phone = ?, 2fa = ? WHERE id = ?", [$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone'], $fa, $user->uid]);
	
	
	}

    $user_driver = $user;
?>
    <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<link rel="stylesheet" href="driverhome.css">
</head>
<center>
<div>
    <div>
        <div class="left">
            <!-- Account Sidebar-->
            <div>
              <!--  <div class="author-card-cover" style="background-image: url(https://demo.createx.studio/createx-html/img/widgets/author/cover.jpg);"><a class="btn btn-style-1 btn-white btn-sm" href="#" data-toggle="tooltip" title="" data-original-title="You currently have 290 Reward points to spend"><i class="fa fa-award text-md"></i>&nbsp;290 points</a></div> -->
                <div>
                    <div><img src="wheezer.jpg">
                    </div>
                    <div>
                        <h2><?php echo $user_driver->getValue('first_name') . " ". $user_driver->getValue('last_name'); ?></h2><span>Joined <?php echo $user_driver->getValue('register_date'); ?></span>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
        <!-- Profile Settings-->
        <div class="">
            <form class="row" action="" method="POST">
              <div class="right">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn"><h3>First Name</h3></label>
                        <input class="form-control" type="text" name='first_name' id="account-fn" value="<?php echo $user_driver->getValue('first_name');?>" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-ln"><h3>Last Name</h3></label>
                        <input class="form-control" type="text" name='last_name' id="account-ln" value="<?php echo $user_driver->getValue('last_name');?>" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-email"><h3>E-mail Address</h3></label>
                        <input name="email" class="form-control" type="email" id="account-email" value="<?php echo $user_driver->email;?>" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-phone"><h3>Phone Number</h3></label>
                        <input name="phone" class="form-control" type="text" id="account-phone" value="<?php echo $user_driver->getValue('phone');?>" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass"><h3>New Password</h3></label>
                        <input class="form-control" type="password" id="account-pass">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass"><h3>Enable 2FA</h3></label>
                        <input class="form-control" type="checkbox" name="2fa" value='1' <?php if($user->getValue('2fa') == 1){ echo "checked";}?>>
                    </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <button name='update' class="btn btn-style-1 btn-primary" type="submit">Update Profile</button>
                    </div></div>
              </div>
              </div>
              
            </form>
        </div>
    </div>
</div>
</center>
</html>
