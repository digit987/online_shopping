<?php
include 'dbOperations.php';
$categoryname=filter_input(INPUT_POST, "categoryname");
echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";
if(addCategory($categoryname)) {
	echo "Category added successfully";	
	echo "<br><a href='adminHome.php'>Go to home</a>";						
}
else {
	echo "Sorry. Category could not be added or already exists.";
        echo "<br><a href='adminHome.php'>Go to home</a>";
}
?>