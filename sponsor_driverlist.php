<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isSponsor())
	header("Location: /home.php");

if($user->getValue("sponsor_company") <= 0)
	Header("Location: sponsorcomp.php")

?>

<title>Driver List</title>
</head>
<body>
  <center>
  <h1>Your current drivers:</h1>
  <ul class="list-group">
  	<?php
	$drivers = $mysqli_si->query("SELECT * from sponsor_drivers WHERE sponsor_company = ?", [$user->getValue('sponsor_company')])->fetchAll("assoc");
	foreach($drivers as $driver){
		$user_driver = new User($mysqli_si, $driver['driver_id']);
		$id = $driver['driver_id'];
		$first_name = $user_driver->getValue('first_name');
		$last_name = $user_driver->getValue('last_name');
	echo "    <a href='sponsor_driver_profile.php?uid=$id'>
      <li class='list-group-item'>$first_name $last_name</li>
    </a>";
	}
	?>
 </ul>
 </center>
</body>
