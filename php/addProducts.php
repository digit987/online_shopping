<?php
include 'dbOperations.php';
$productname=filter_input(INPUT_POST, "productname");
$brand=filter_input(INPUT_POST, "brand");
$categoryname=filter_input(INPUT_POST, "categoryname");
$price=filter_input(INPUT_POST, "price");
$quantity=filter_input(INPUT_POST, "quantity");
$image=filter_input(INPUT_POST, "image");

echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";

if(addProducts($productname, $brand, $categoryname, $price, $quantity, $image)) {
	echo "Product added successfully";	
	echo "<br><a href='adminHome.php'>Go to home</a>";						
}
else {
	echo "Sorry. Product could not be added.";
        echo "<br><a href='adminHome.php'>Go to home</a>";
}
?>