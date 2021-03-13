<?php
session_start();
include 'dbOperations.php';
$username=$_SESSION["username"];
$email=filter_input(INPUT_POST, "email");
$phoneno=filter_input(INPUT_POST, "phoneno");
$address=filter_input(INPUT_POST, "address");

echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";

if(updateUserProfile($username, $email, $phoneno, $address)) {
	echo "$username, your profile has been updated successfully";	
	echo "<br><a href='userHome.php'>Proceed to Home Page</a>";						
}
else {
	echo "Sorry. Your profile could not be updated.";
}
?>