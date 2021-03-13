<?php
$username=filter_input(INPUT_POST, "username");
$answer=filter_input(INPUT_POST, "answer");
$newPassword=filter_input(INPUT_POST, "newPassword");

if(resetPassword($username, $answer, $newPassword)) {
	echo "$name, your new password has been set";	
	echo "<br><a href='../index.html'>Proceed to login</a>";						
}
else {
	echo "Sorry. You could not be identified.";
}
?>

