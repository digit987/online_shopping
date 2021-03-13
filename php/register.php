<?php
include 'dbOperations.php';
$firstname=filter_input(INPUT_POST, "firstname");
$middlename=filter_input(INPUT_POST, "middlename");
$lastname=filter_input(INPUT_POST, "lastname");
$password=filter_input(INPUT_POST, "password");
$email=filter_input(INPUT_POST, "email");
$phoneno=filter_input(INPUT_POST, "phoneno");
$address=filter_input(INPUT_POST, "address");
$recoveryanswer=filter_input(INPUT_POST, "answer");

echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";

if($middlename==null){
	$name=$firstname.' '.$lastname;
}
elseif ($middlename!=null) {
	$name=$firstname.' '.$middlename.' '.$lastname;
}
if(register($name, $password, $email, $phoneno, $address, $recoveryanswer)) {
	echo "$name, you have been registered successfully";	
	echo "<br><a href='../index.html'>Proceed to login</a>";						
}
else {
	echo "Sorry. You could not be registered.";
}
?>