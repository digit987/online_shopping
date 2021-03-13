<?php
session_start();
$username=$_SESSION["username"];
session_unset();
session_destroy();
echo 'Logged Out successfully. Thank You.';
echo '<br>';
if ($username=="admin") {
    echo "Log In <a href='../html/loginAdmin.html'>here</a>";
}
else {
    echo "Log In <a href='../index.html'>here</a>";
}
?>


