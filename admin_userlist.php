<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isAdmin())
	header("Location: /home.php");
?>

<title>Driver List</title>
</head>
<body>
  <center>
  <h1>Your current users:</h1>
  <ul class="list-group">
  	<?php
	$users = $mysqli_si->query("SELECT * from users")->fetchAll("assoc");
	foreach($users as $user){
		$user_driver = new User($mysqli_si, $user['id']);
		$id = $user['id'];
		$first_name = $user_driver->getValue('first_name');
		$last_name = $user_driver->getValue('last_name');
	echo "    <a href='admin_driver_edit.php?uid=$id'>
      <li class='list-group-item'>$first_name $last_name</li>
    </a>";
	}
	?>
 </ul>
 </center>
</body>
