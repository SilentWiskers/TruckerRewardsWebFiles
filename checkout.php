
<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if($user->isSponsor())
  header("Location: /home.php");

if(isset($_GET['add'])){
    $insert = $mysqli_si->query("INSERT INTO cart_items (driver_id, item_id) VALUES (?, ?)", [$user->uid, $_GET['add']]);
}

if(isset($_GET['del'])){
    $delete = $mysqli_si->query("DELETE FROM cart_items WHERE id = ?", [$_GET['del']]);
}
?>
<body>
<div class="container">
		
	<table id="example" class="table table-striped table-bordered" style="width:60%">
        <thead>
            <tr>
                <th>Order Summary:</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $items = $mysqli_si->query("SELECT * FROM `cart_items` WHERE driver_id = ?", [$user->uid])->fetchAll("assoc");
        $total = 0;
        foreach($items as $item){
            $id = $item['item_id'];
            $cart_id = $item['id'];
            $item_row = $mysqli_si->query("SELECT * FROM `catalog_item` WHERE id = ?", [$id])->fetch("assoc");
            $name = $item_row['item_name'];
            $sponsor_company = $mysqli_si->query("SELECT * FROM `sponsors` WHERE id = ?", [$item_row['sponsor_id']])->fetch("assoc");
            $price = $item_row['price'] / $sponsor_company['point_value'];
            $total = $total + $price;

            echo "<tr>
            <td>$name</td>
            <td>$price pts</td>
            <td><a href='checkout.php?del=$cart_id'><button name='submit' class='add' type='submit'>Remove Item</button></a></td>
        </tr>";
        }
        

        ?>
		</tbody>
    </table>
    <div class="right">
	<b><p>Total Points: <?php echo $total; ?></p></b>
	<a href="process_checkout.php"><button name="submit" class="add" type="submit">Checkout</button></a>
	</div>

	
	
    </div>
</body>
</html>
