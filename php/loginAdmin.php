<?php
session_start();
include 'dbOperations.php';
$username=filter_input(INPUT_POST, "username");
$password=filter_input(INPUT_POST, "password");
if(loginAdmin($username,$password)) {
	$_SESSION["username"]=$username;
	header('Location: adminHome.php');
}
else {
	header('Location: ../html/loginError.html');
}
?>