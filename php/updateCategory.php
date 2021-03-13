<?php
include 'dbOperations.php';
$oldcategoryname=filter_input(INPUT_POST, "oldcategoryname");
$newcategoryname=filter_input(INPUT_POST, "newcategoryname");

echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";

if(updateCategory($oldcategoryname, $newcategoryname)) {
	echo "Category updated successfully";	
	echo "<br><a href='adminHome.php'>Go to home</a>";						
}
else {
	echo "Sorry. Category could not be added or already exists.";
        echo "<br><a href='adminHome.php'>Go to home</a>";
}
?>