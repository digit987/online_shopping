<?php
include 'dbOperations.php';
$productname=filter_input(INPUT_POST, "productname");
echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";
if(deleteProducts($productname)) {
    echo "Product deleted successfully";  
    echo "<br><a href='adminHome.php'>Go to home</a>";
}
else {
    echo "Sorry. Product could not be deleted. Perhaps it does not exist.";
    echo "<br><a href='adminHome.php'>Go to home</a>";
}
?>
