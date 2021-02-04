<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isSponsor())
	header("Location: /home.php");

if($user->getValue("sponsor_company") <= 0)
	Header("Location: sponsorcomp.php")
?>
<body>
	
	<div class="container">
	<h1>Catalog Purchase History</h1>
	<table>
  		<tr>
    		<th>Date</th>
			<th>Item</th>
    		<th>Points Spent</th>
			<th>Purchased By</th>
			
  		</tr>
		  <tbody>
		  <?php
$purchases = $mysqli_si->query("SELECT * from purchases")->fetchAll("assoc");

foreach($purchases as $purchase){
	$item = $mysqli_si->query("SELECT * from catalog_item WHERE id = ?", [$purchase['item_id']])->fetch("assoc");
	if($item['sponsor_id'] == $user->getValue("sponsor_company")){
		$user1 = $mysqli_si->query("SELECT * from users WHERE id = ?", [$purchase['driver_id']])->fetch("assoc");
		$date = $purchase['purchase_time'];
		$points = $purchase['points'];
		$email = $user1['email'];
		$iname = $item['item_name'];
		echo "<tr>
		<td class='first'>$date</td>
		<td><a>$iname</a></td>
		<td class='last'>$points pts</td>
		<td><a>$email</a></td>
	  </tr>";

	}

}
?>
</tbody>
	</table>
	</div>
	</body>
</html>