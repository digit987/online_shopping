<?php
include 'dbOperations.php';
echo "".
"<!DOCTYPE html>".
"<html>".
"<head>".
"<meta charset='ISO-8859-1'>".
"<title>Registration</title>".

"</head>".
"<body>".
        "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>".
"<div align='center'>".
            "<h1>Add Product</h1>".
            "<form id='addProducts' method='post' action='../php/addProducts.php'>".
            "<table>".
                "<tr> <td>Enter Product Name<td><input type='text' name='productname'/></td></tr>".
                    
                "<tr> <td>Enter Brand<td><input type='text' name='brand'/></td></tr>".
                
                "<tr> <td>Enter Category Name".
                    "<td>".
                        "<select name='categoryname'>";
                        for($i=0;$i<count(getCategory());$i++) {                          
                            echo "<option value='getCategory()[$i]'>".getCategory()[$i]."</option>";
                        }
                        echo "".                   
                        "</select> ".
                        "</td>".
                "</tr>".
                
                "<tr> <td>Enter Price<td><input type='text' name='price'/></td></tr>".
                
                "<tr> <td>Enter Quantity<td><input type='text' name='quantity'/></td></tr>".
                
                "<tr><td>Enter Current Rating<td><input type='text' name='current_rating'/></td></tr>".
                
                "<tr> <td>Enter Image Path<td><input type='text' name='image'/></td></tr>".
                
                "<tr> <td td colspan='2' align='center'> <button>Add Products</button></td></tr>".
                                
            "</form> ".                                      
        "</div>".

"</body>".
"</html>";
?>

