<?php
include("db.php");

if($user->uid){
  if($user->isDriver())
    include("header_driver.php");

  else if($user->isSponsor())
    include("header_sponsor.php");

  else if($user->isAdmin())
    include("header_admin.php");
}
else
  include("header_default.php");
?>