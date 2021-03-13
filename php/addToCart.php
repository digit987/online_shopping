<?php
include 'dbOperations.php';
session_start();
$quantity=  filter_input(INPUT_POST, 'quantity');
$username=$_SESSION['username'];
$productname=$_SESSION['productname'];

echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";

if(addToCart($username, $productname, $quantity)) {
	echo "Product added to cart successfully";	
        updateQuantity($productname, $quantity);
        deleteFromCart($username, $productname);
	echo "<br><a href='viewProducts.php'>Buy More products</a>";
        echo "<br><a href='viewCart.php'>Proceed to Checkout</a>";
}
else {
	echo "Sorry. Product could not be added to cart or the quantity you entered is exceptional.";
}
?>