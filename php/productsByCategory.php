<?php
session_start ();
include 'dbOperations.php';

echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";
// If admin views products
if ($_SESSION["username"]=="admin") {
    showProductToAdmin($_POST['categoryname']);
}

// If user views products
else {    
    callShowProductToUser($_POST['categoryname']);
}
?>