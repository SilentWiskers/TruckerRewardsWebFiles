<?php
include("inc/header.php");
if(!$user->is_logged_in())
	header("Location: /login.php");

if(!$user->isSponsor())
	header("Location: /driverhome.php");

if($user->getValue("sponsor_company") <= 0)
	Header("Location: sponsorcomp.php");


if(isset($_POST['add']))
{
	$insert = $mysqli_si->query("INSERT INTO catalog_item (sponsor_id, item_url) VALUES (?, ?)", [$user->getValue('sponsor_company'), $_POST['url']]);
	echo "<script>alert('Item added to catalog, please wait up to 5 minutes for the item details to be pulled from eBay!')</script>";
}
?>

<body>
	<div class="container">
	<div class="top-left">
	<form action="" method="POST">
		<button name="add" class="add" type="submit">Add Item</button>
		<input name='url' type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" style="height: 31px;">
	</form>
	</div>
		
	<table id="example" class="table table-striped table-bordered" style="width:96%">
        <thead>
            <tr>
                <th>Item Number</th>
				<th>Item Name</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
		<?php
			$items = $mysqli_si->query("SELECT * FROM `catalog_item` WHERE sponsor_id = ?", [$user->getValue('sponsor_company')])->fetchAll("assoc");
			foreach($items as $item){
				$id = $item['id'];
				if($item['item_name'])
					$name = $item['item_name'];
				else
					$name = "Waiting for item details to be pulled from eBay...";
			echo "<tr>
					<td>$id</td>
					<td>$name</td>
					<td><a href='remove_item.php?id=$id'><button name='submit' class='add' type='submit'>Remove Item</button></a></td>";
				}
				
		?>
            </tr>
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
