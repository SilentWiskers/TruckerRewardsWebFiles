<?php
include("db.php");

$items = $mysqli_si->query("SELECT * FROM `catalog_item` WHERE item_name IS NULL or item_name = ''", [])->fetchAll("assoc");
foreach ($items as $item) {
    $url = $item['item_url'];

    $parts = explode('/', $url);
    $id = trim(end($parts), '?');
    $p2 = explode('?', end($parts));
    $id = $p2[0];

    $apicall = "http://open.api.ebay.com/shopping?"; // URL to call
    $apicall .= "callname=GetSingleItem";
    $apicall .= "&appid=CJSculti-DrivingA-PRD-9ef686bae-821b6406";
    $apicall .= "&version=949"; // API version supported by your application
    $apicall .= "&siteid=0"; // 0 for United States
    $apicall .= "&responseencoding=XML";
    $apicall .= "&ItemID=$id"; // Listing number

    // Load the call and capture the document returned by eBay API
    $resp = simplexml_load_file($apicall);
    if($resp->Errors){
        $mysqli_si->query("DELETE FROM `catalog_item` WHERE id = ?", [$item['id']]);

    }
    else
        $update = $mysqli_si->query("UPDATE `catalog_item` SET item_name = ?, price = ?, image = ? WHERE id = ?", [$resp->Item->Title, $resp->Item->ConvertedCurrentPrice, $resp->Item->PictureURL[0], $item['id']]);
    // Output response
    echo ("<pre>");
    print_r($resp);
    echo ("</pre>");
}
?>