
<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if($user->isSponsor())
  header("Location: /home.php");
  
$driver_sponsors = $mysqli_si->query("SELECT * FROM `sponsor_drivers` WHERE driver_id = ? AND sponsor_company = ?", [$_SESSION['user_id'], $_GET['id']])->fetchAll("assoc");

if(count($driver_sponsors) < 1)
  header("Location: /home.php");

?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="Catalog.css">
<style>
.w3-bar-block .w3-bar-item {padding:20px}
</style>
<body>
<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Close Menu</a>
  <a href="#food" onclick="w3_close()" class="w3-bar-item w3-button">Food</a>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">About</a>
</nav>

  
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:50px">
	
	<div class="header">
  <?php 
  $sponsor_company = $mysqli_si->query("SELECT * FROM `sponsors` WHERE id = ?", [$_GET['id']])->fetch("assoc");
    echo "<h1>".$sponsor_company['company_name']." Catalog</h1>";
  ?>
	
	</div>
	
	<div class="top-left">
	<label>
		Search <input type="search" class="box" placeholder="" aria-controls="example">
	</label>
	</div>
  <?php
    $items = $mysqli_si->query("SELECT * FROM `catalog_item` WHERE sponsor_id = ?", [$_GET['id']])->fetchAll("assoc");
    $num = 0;
    
    foreach($items as $item){
      $id = $item['id'];
      $name = $item['item_name'];
      $price = $item['price'] / $sponsor_company['point_value'];
      $image = $item['image'];
    
      if($num == 0)
        echo "<div class='w3-row-padding w3-padding-16 w3-center'>";
      echo "<div class='w3-quarter'>
        <img src='$image' style='width:100%'>
        <h3>$name</h3>
      <h4>$price pts</h4>
        <p>Furniture with more chairs</p>
      <a href='checkout.php?add=$id'><button name='submit' class='add' type='submit'>Add to Cart</button></a>
      </div>";
      if($num == 3){
        echo "</div>";
        $num = 0;
      }
      else
        $num++;
    }
  ?>
</div>

</body>
</html>
