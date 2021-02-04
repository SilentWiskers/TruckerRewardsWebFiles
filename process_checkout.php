<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if($user->isSponsor())
  header("Location: /home.php");


?>
<body>
<div class="container">
<?php
    $items = $mysqli_si->query("SELECT * FROM `cart_items` WHERE driver_id = ?", [$user->uid])->fetchAll("assoc");
    foreach($items as $item){
        $id = $item['item_id'];
        $item_row = $mysqli_si->query("SELECT * FROM `catalog_item` WHERE id = ?", [$id])->fetch("assoc");
        $name = $item_row['item_name'];
        $sponsor_company = $mysqli_si->query("SELECT * FROM `sponsors` WHERE id = ?", [$item_row['sponsor_id']])->fetch("assoc");
        $price = $item_row['price'] / $sponsor_company['point_value'];
        $sponsor_driver = $mysqli_si->query("SELECT * FROM `sponsor_drivers` WHERE sponsor_company = ? AND driver_id = ?", [$item_row['sponsor_id'], $user->uid])->fetch("assoc");
        $available_points = $sponsor_driver['points'];
        
        if($available_points < $price){
            echo "<div class='alert alert-danger' role='alert'>
            Checkout failed, not enough points! Item: <b>$name</b>
          </div>
          ";
        }
        else{
            $update = $mysqli_si->query("UPDATE sponsor_drivers SET points = points - ? WHERE driver_id = ? AND sponsor_company = ?", [$price, $user->uid, $item_row['sponsor_id']]);
            $insert = $mysqli_si->query("INSERT INTO purchases (driver_id, item_id, points) VALUES (?, ?, ?)", [$user->uid, $id, $price]);
            $delete = $mysqli_si->query("DELETE FROM cart_items WHERE id = ?", [$item['id']]);
            echo "<div class='alert alert-success' role='alert'>
            Checkout successful! Item: <b>$name</b>
          </div>
          ";
        }
    }

?>
	
</div>
</body>
</html>
