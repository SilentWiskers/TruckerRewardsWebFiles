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
  <h1>Your current sponsors:</h1>
  <ul class="list-group">
  	<?php
	$sponsors = $mysqli_si->query("SELECT * from sponsors")->fetchAll("assoc");
	foreach($sponsors as $sponsor){
    $id = $sponsor['id'];
		$company_name = $sponsor['company_name'];
    $_SESSION['sponsor'] = $sponsor;
	echo "    <a href='editcompany.php?id=$id'>
      <li class='list-group-item'>$company_name</li>
    </a>";
	}
	?>
 </ul>
 </center>
</body>
