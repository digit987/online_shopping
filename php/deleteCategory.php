<?php
include 'dbOperations.php';
$categoryname=filter_input(INPUT_POST, "categoryname");
echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";
if(deleteCategory($categoryname)) {
    echo "Category deleted successfully";  
    echo "<br><a href='adminHome.php'>Go to home</a>";
}
else {
    echo "Sorry. Category could not be deleted. Perhaps it does not exist or a product has been purchased under it.";
}
?>
