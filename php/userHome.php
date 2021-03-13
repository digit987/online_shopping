<?php
session_start();

echo "<body>".
        "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>".
"<div align='center'>".
            "Hello, ". $_SESSION["username"].  
            "<form method='post' action='userPurchaseHistory.php'>".        
            "<table align='center'>".               
                
                "<tr> <td> <button formaction='userPurchaseHistory.php'>Purchase History</button> </td>".
                
                "<tr> <td> <button formaction='viewCart.php'>View Cart</button></td>".
                
                "<tr> <td> <button formaction='viewProducts.php'>View Products</button></td>".    

                "<tr> <td> <button formaction='../html/updateUserProfile.html'>Update Profile</button></td>".        
			"</form>".
		"</div>".
"</body>";
?>