<?php
session_start();

echo "<body>". 
        "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>".
"<div>".
            "Hello, ". $_SESSION["username"].  
            "<form method='post' action='viewProducts.php'>".               
            "<table align='center'>".               
                
                "<tr> <td> <button>View Products</button> </td>".
                
                "<tr> <td> <button formaction='allUsersPurchaseHistory.php'>Purchase History</button></td>".
                
                "<tr> <td> <button formaction='addProductForm.php'>Add Products</button></td>".    

                "<tr> <td> <button formaction='../html/updateProducts.html'>Update Products</button></td>".
                
                "<tr> <td> <button formaction='../html/deleteProducts.html'>Delete Products</button></td>".
                
                "<tr> <td> <button formaction='../html/addCategory.html'>Add Category</button></td>".
                
                "<tr> <td> <button formaction='../html/updateCategory.html'>Update Category</button></td>".
                
                "<tr> <td> <button formaction='../html/deleteCategory.html'>Delete Category</button></td>".
                "</form>".
        "</div>".		
"</body>";
?>