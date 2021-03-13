<?php
session_start();
$_SESSION['productname']=filter_input(INPUT_POST,'productname');
echo "".
"<!DOCTYPE html>".
"<html>".
"<head>".
"<title>Add To Cart</title>".
"</head>".
"<body>".    
    "<form method='post' action='../php/addToCart.php' align='right'>".
        "<button>Log Out</button>".
            "</form>".
"<div align='center'>".
            "<h1>".
                "Product Name: ". $_SESSION['productname'].                
            "</h1>".
            "<form id='update' method='post' action='../php/addToCart.php'>".
            "<table>".
                
                "<tr><td>Enter Quantity<td><input type='text' name='quantity'/>".
                
                "<tr> <td td colspan='2' align='center'> <button>Add</button>".
                                
            "</form>".                                       
        "</div>".

"</body>".
"</html>";
?>