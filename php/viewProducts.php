<?php
session_start();
include 'dbOperations.php';
echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>".
 "<body>".
"<div align='center'>".
            "Hello, ". $_SESSION["username"]. 
            ". How would you like to see products".  
            
            "<form method='post' action='productsByCategory.php'>".        
            "<table align='center'>".                               
                "Products by Category".                
                "<tr>";
                        for($i=0;$i<count(getCategory());$i++) {                            
                            echo "<td> <button name='categoryname' value=".getCategory()[$i].">".getCategory()[$i]."</button> </td>";
                        }                		
                echo "</tr>".                
                "</table>".                
                "</form>".
                
                /* "<form method='post' action='productsByPrice.php'>".
                "<table align='center'>".                
                "<i>Products by Price</i>".                
                "<tr>".
                "<td> <button name='1-100'>1-100</button> </td>".
                "<td> <button name='100-500'>100-500</button> </td>".
                "<td> <button name='500-1000'>500-1000</button> </td>".
                "<td> <button name='1000-5000'>1000-5000</button> </td>".
                "<td> <button name='Above 5000'>Above 5000</button> </td>".
                "</tr>".                
                "</table>".                
                "</form>".
                
                "<form method='post' action='productsByPopularity.php'>".
                "<button name='productsByPopularity'>Products by Popularity</button>".
                "</form>". */
                
        "</div>".		
"</body>";
?>