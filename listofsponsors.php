<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isSponsor())
	header("Location: /driverhome.php");

if($user->getValue("sponsor_company") <= 0)
	Header("Location: sponsorcomp.php");

	?>
<head>
	<link type="text/css" rel="stylesheet" href="listofsponsors.css">
</head>
<body>
<div class="container">

	<div class="top">
	<h2>Showing Sponsors in Company</h2>
	</div>
	
	
	<table id="example" class="table table-striped table-bordered" style="width:96%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone#</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
		<?php
			$items = $mysqli_si->query("SELECT * FROM `users` WHERE sponsor_company = ?", [$user->getValue('sponsor_company')])->fetchAll("assoc");
			foreach($items as $item){
				$name = $item['first_name'] . " " . $item['last_name'];
				$email = $item['email'];
				$phone = $item['phone'];
				$id = $item['id'];
            echo"<tr>
                <td>$name</td>
                <td>$email</td>
                <td>$phone</td>
				<td><a href='remove_sponsor.php?id=$id'><button name='submit' class='add' type='submit'>Remove User</button></a></td>
			</tr>";
			}
			?>
		</tbody>
    </table>
		</div>
</body>
</html>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>