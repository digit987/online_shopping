<?php

function getConnection() { 
    $servername="localhost";
    $database="onlineShopping";
    $username="root";
    $password="";
    $conn= mysqli_connect($servername, $username, $password, $database);
if(!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
return $conn;
}

function closeConnection(){    
    mysqli_close(getConnection());
}

?>

