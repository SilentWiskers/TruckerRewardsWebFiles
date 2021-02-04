<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isAdmin())
	header("Location: /home.php");
	
$sponsors = $mysqli_si->query("SELECT * from sponsors")->fetchAll("assoc");
?>
<!DOCTYPE html>
 <html>
 <head>
   <title>Sales Report</title>
 </head>
 <body>
 <div class="container">
 <div class="card">
   <center>
   <h1>Sales Report</h1>
   <table style="width:100%">
     <tr>
       <th>Sponsor Company</th>
       <th>Items Sold</th>
       <th>Total Sales</th>
       <th>Total Revenue (1% of sales)</th>
     </tr>

     <?php
      foreach($sponsors as $sponsor){
        $total = 0;
        $total_purchases = 0;
        $purchases = $mysqli_si->query("SELECT * from purchases")->fetchAll("assoc");

foreach($purchases as $purchase){
	$item = $mysqli_si->query("SELECT * from catalog_item WHERE id = ?", [$purchase['item_id']])->fetch("assoc");
	if($item['sponsor_id'] == $sponsor['id']){
        $total = $total + $item['price'];
        $total_purchases++;
      }
    }
    $name = $sponsor['company_name'];
    $revenue = $total / 100;

    echo "<tr>
<th>$name</th>
<th>$total_purchases</th>
<th>$$total</th>
<th>$$revenue</th>
</tr>
";
  }
     ?>

   </table>
 </center>
 </div>
 </div>
 </body>
 </html>
