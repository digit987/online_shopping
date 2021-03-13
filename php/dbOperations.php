<?php

//This page contains all the functions to implement all the operations performed by the actors such as admin and the user.
//dbConnection.php contains the function getConnection() that connects to the database and returns $conn variable. 
include 'dbConnection.php';
$conn = getConnection ();

//This function logs in admin.
function loginAdmin($username, $password) {
	global $conn;
	$query = "select username, password from admin where username='$username' and password='$password'";
	$result = $conn->query ( $query );
	if (mysqli_num_rows ( $result ) == 1) {
		closeConnection ();
		return true;
	} else {
		closeConnection ();
		return false;
	}
}

//This function registers the user. 
//$recoveryanswer is the recovery answer used for recovering the account when the user forgets his/her password. 
function register($name, $password, $email, $phoneno, $address, $recoveryanswer) {
	global $conn;
	$query = "select username from users";        
        $username = explode ( " ", $name )[0] . (mysqli_num_rows ( mysqli_query ( $conn, $query ) ) + 1);
        $query = "insert into users values('$username', '$name', '$password', '$email', '$phoneno', '$address', '$recoveryanswer')";        	
	if ($conn->query ( $query )) {
		return true;
	} else {
		return false;
	}
	closeConnection ();
}

//This function logs in user.
function loginUser($username, $password) {
	global $conn;
	$query = "select username, password from users where username='$username' and password='$password'";
	$result = $conn->query ( $query );
	if (mysqli_num_rows ( $result ) == 1) {
		closeConnection ();
		return true;
	} else {
		closeConnection ();
		return false;
	}
}

//This function sets the password when it has been forgotten by the user.
//answer is the recovery answer.
function resetPassword($username, $answer, $newPassword) {
    global $conn;
	$query = "select username, answer from users where username='$username' and answer='$answer'";
	$result = $conn->query ( $query );
	if (mysqli_num_rows ( $result ) == 1) {
            $query = "update users set password='$newPassword' where username='$username' and answer='$answer'";
            if($result = $conn->query ( $query )) {
                closeConnection ();
                return true;
            }                                   
	} else {
		closeConnection ();
		return false;
	}
}

//This function updates the user profile. As of now, email, phone number and address can be updated.
function updateUserProfile($username, $email, $phoneno, $address) {
        global $conn;        
        $query = "update users set email='$email', phoneno='$phoneno', address='$address' where username='$username' ";
        if ($conn->query ( $query )) {
                return true;
        } else {
                return false;
        }
        closeConnection ();
}

//This function displays category wise products to admin
function showProductToAdmin($category) {
	global $conn;	
	$query = "select * from products where category_id in (select category_id from category where category_name='$category')";
	$result = $conn->query ( $query );		
	if ($result->num_rows > 0) {	
            echo "<table border='1'>" . "<tr>" . "<th>Product Name</th>" ."<th>Price</th>" . "<th>Quantity</th>" . "<th>Current Rating</th>" . "</tr>";
		while ( $row = $result->fetch_assoc () ) {
			echo "<tr>" . "<td>" . $row ['product_name'] . "</td>" . "<td>" . $row ['price'] . "</td>" . "<td>" . $row ['quantity'] . "</td>" . "<td>" . $row ['current_rating'] . "</td>" . "</tr>";
		}		
	echo "</table>";
	} else {
		echo "No product exists for this category '$category'.<br/>Kindly click <a href='../html/addProducts.html'>here</a> to add products</a>";
	}
}

//This function makes admin see all the purchase history of all the users who purchased the products.
function allUsersPurchaseHistory() {
	global $conn;
	$query = "select * from purchase_history";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		echo "<table border='1'>" . "<tr>" . "<th>Username</th>" ."<th>Product Name</th>" . "<th>Time</th>" . "<th>Rating</th>" . "</tr>";
		while ( $row = $result->fetch_assoc () ) {
			echo "<tr>" . "<td>" . $row ['username'] . "</td>" . "<td>" . getProductName($row ['product_id']) . "</td>" . "<td>" . $row ['time'] . "</td>" . "<td>" . $row ['rating'] . "</td>" . "</tr>";
		}
		echo "</table>";
	} else {
		echo "Users have not purchased anything yet.<br/>Kindly click <a href='../html/index.html'>here</a> to buy products</a>";
	}
}

//This function makes admin add new products in the table.
function addProducts($productname, $brand, $categoryname, $price, $quantity, $image) {
    global $conn;
    $category_id="";
    $query = "select category_id from category where category_name='$categoryname'";
    $result = $conn -> query ( $query );    
    if ($result -> num_rows == 1 ) {
        while ( $row = $result -> fetch_assoc () ) {
            $category_id = $row ['category_id'];
        }
    }    
    $query = "select product_id from products";
    $productid = $productname . (mysqli_num_rows ( mysqli_query ( $conn, $query ) ) + 1);
    $query = "insert into products(product_id, product_name, brand, category_id, price, quantity, image) values('$productid', '$productname', '$brand', '$category_id', '$price', '$quantity', '$image')";
    if ($conn -> query ( $query )) {
            return true;
    } else {
            return false;
    }
    closeConnection ();
}

//This function returns boolean result to inform if a certain product exists. 
function existsProduct($productname) {
    global $conn;
    $query="select product_name from products where product_name='$productname' ";
    $result = $conn->query($query);
    if (mysqli_num_rows($result) > 0 ) {
        return true;
    }
    return false;
}

//This function makes admin update products. As of now, product name, brand, price, quantity, image can be updated.
//It is worth to be noted that all the properties displayed in the form should be updated (may contain previous values).
function updateProducts($productname, $brand, $categoryname, $price, $quantity, $image) {
    global $conn;
    if(existsProduct($productname)) {
        $query="select category_id from category where category_name='$categoryname' ";
        $result = $conn->query($query);
        $category_id=0;
        if (mysqli_num_rows($result) == 1 ) {        
            $category_id = $result -> fetch_assoc() ['category_id'];        
        }
        $query = "update products set product_name='$productname', brand='$brand', category_id='$category_id', price='$price', quantity='$quantity', image='$image' where product_name='$productname' ";
        if ($conn -> query ( $query )) {
                return true;
        } else {
                return false;
        }    
        closeConnection ();
    }
    else {
        return false;
    }
}

//This function makes admin delete a certain product.
function deleteProducts($productname) {
    if(existsProduct($productname)) {
        global $conn;
        $query="delete from products where product_name='$productname' ";    
        if($conn -> query($query)) {
            return true;        
        }
        else {
            return false;
        }
    } 
    else {
        return false;
    }
}

//This function makes admin add a certain category.
function addCategory($categoryname) {
    global $conn;
    $query = "select category_name from category where category_name='$categoryname'";
    $result = $conn -> query ( $query );
    if ($result -> num_rows == 0 ) {
        $query = "select category_id from category";
        $category_id = $categoryname . (mysqli_num_rows ( mysqli_query ( $conn, $query ) ) + 1);
        $query = "insert into category values('$category_id', '$categoryname')";        
        if ($conn->query ( $query )) {
                return true;
        } else {
                return false;
        }
        closeConnection ();
        }
    else {
        return false;
    }
}

//This function makes admin update a category name.
function updateCategory($oldcategoryname, $newcategoryname) {
    global $conn;
    $query="update category set category_name='$newcategoryname' where category_name='$oldcategoryname' ";    
    if ($conn->query($query) ) {        
        return true;       
    }      
    else {
        return false;
    }
    closeConnection ();
}

//This function makes admin delete a category. The condition is that
//no product should be existing for that category in the products table.
function deleteCategory($categoryname) {
    global $conn;    
    $query="select * from purchase_history,products where purchase_history.product_id=products.product_name "
            . "and products.category_id=(select category_id from category where category_name='$categoryname') ";    
    $result = $conn->query($query);        
    if (mysqli_num_rows($result) == 0 ) {        
        $query="delete from category where category_name='$categoryname' "; 
        if($conn -> query($query)) {
        return true;        
    }
    else {
        return false;
    }
    }
    else {
        return false;
       }
}

//This function returns an array of all the categories.
function getCategory() {
    global $conn;    
    $query="select category_name from category";    
    $result = $conn->query($query);
    $categorynames[]=array();	
	if ($result->num_rows > 0) {
		$i=0;
                while ( $row = $result->fetch_assoc () ) {
                    $categorynames[$i]=$row['category_name'];
                    $i++;
                }
        }
        return $categorynames;
}

//This function return the id of a product given its name.
function getProductId($productname) {
    global $conn;
    $product_id='';
    $query = "select product_id from products where product_name='$productname'";
    $result = $conn -> query ( $query );
    if ($result -> num_rows == 1 ) {
        while ( $row = $result->fetch_assoc () ) {
            $product_id=$row ['product_id'];
        }
    }
    return $product_id;
}

//This function return the name of a product given its id.
function getProductName($productid) {
    global $conn;
    $product_name='';
    $query = "select product_name from products where product_id='$productid'";
    $result = $conn -> query ( $query );
    if ($result -> num_rows == 1 ) {
        while ( $row = $result->fetch_assoc () ) {
            $product_name=$row ['product_name'];
        }
    }
    return $product_name;
}

//This function return the quantity of a product given its name.
function getQuantity($productname) {
    global $conn;
    $quantity=null;
    $query = "select quantity from products where product_name='$productname'";
    $result = $conn -> query ( $query );
    if ($result -> num_rows == 1 ) {
        while ( $row = $result->fetch_assoc () ) {
            $quantity=$row ['quantity'];
        }
    }
    return $quantity;
}

//This function return the purchase history of a user given his/her name.
function showPurchaseHistory($username) {
	global $conn;
	$query = "select * from purchase_history where username='$username'";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		echo "<table border='1'>" . "<tr>" . "<th>Product Name</th>" . "<th>Time</th>" . "<th>Your Rating</th>" . "</tr>";
		while ( $row = $result->fetch_assoc () ) {
			echo "<tr>" . "<td>" . getProductName($row ['product_id']) . "</td>" . "<td>" . $row ['time'] . "</td>" . "<td>" . $row ['rating'] . "</td>" . "</tr>";
		}
		echo "</table>";
	} else {
		echo "You have not purchased anything yet.<br/>Kindly click <a href='../php/viewProducts.php'>here</a> to buy products</a>";
	}
}

//This function return an array of all the products under a category as selected.
function showProductToUser($category) {
	global $conn;	
	$query = "select * from products where category_id in (select category_id from category where category_name='$category')";
        $result = $conn -> query ( $query );
        if ($result->num_rows == 0) {            
            return NULL;
        }
        elseif ($result->num_rows > 0) {
            $product[][]=array();
            $i=0;
            while ( $row = $result->fetch_assoc () ) {
                    $product[$i][0]=$row['product_id'];
                    $product[$i][1]=$row['product_name'];
                    $product[$i][2]=$row['brand'];
                    $product[$i][3]=$row['category_id'];
                    $product[$i][4]=$row['price'];
                    $product[$i][5]=$row['quantity'];
                    $product[$i][6]=$row['current_rating'];
                    $product[$i][7]=$row['image'];
                    $i++;
            }		
	}
        return $product;				
}

// This function invokes the function showProductUser($category) to display details of all the products in a category in HTML format.
function callShowProductToUser($category) {
    if (showProductToUser($category)==null) {
        echo "No product exists for this category!!!";
    }
    else {
        echo "<table>".
            "<tr>";
	for($j = 0; $j < count ( showProductToUser("$category") ); $j ++) {                      
		echo "<td><form method='post' action='addQuantity.php'>";
                echo showProductToUser("$category")[$j][7]."<br>";
                echo "Product Name: ".showProductToUser("$category")[$j][1]."</br>";
                echo "<input type='hidden' name='productname' value=".showProductToUser("$category")[$j][1]."></input><br>";
                echo "Brand: ".showProductToUser("$category")[$j][2]."<br>";
                echo "Price: ".showProductToUser("$category")[$j][4]."<br>";
                echo "Quantity: ".showProductToUser("$category")[$j][5]."<br>";
                echo "Current Rating: ".showProductToUser("$category")[$j][6]."<br>"; 
                if(showProductToUser("$category")[$j][5]==0) {
                echo "Out of Stock";
            }
            else {
                echo "<button>Add to Cart</button>";
            }                
                echo "</form>";
                echo "</td>";
                if(($j+1)%3==0) {
                            echo "</tr><tr>";
                        }                
	}
        echo "</tr>";
    }       
}

//This function return a boolean result to inform wether a product exists in the cart of a user given the names of both the product and the user.
function productInCart($username, $productname) {
    global $conn;
    $query = "select * from cart where username='$username' and product_id=".  getProductId($productname);
    $result = $conn -> query ( $query );
    if ($result -> num_rows > 0 ) {
        return true;
    }
    else {
        return false;
    }
}

//This function adds a product to the cart of a user.
function addToCart($username, $productname, $quantity) {
        global $conn;        
        if(getQuantity($productname)<$quantity || $quantity <= 0) {
            closeConnection ();
            return false;
        }
        else {
            if(productInCart($username, $productname)) {
            $query = "update cart set quantity=quantity+'$quantity' ";
            if ($conn -> query ( $query )) {                
                closeConnection ();
                return true;
            }
        }
        else  {
            $query = "select cart_id from cart";
            $cartid = mysqli_num_rows ( mysqli_query ( $conn, $query ) ) + 1;
            $query = "insert into cart values('$cartid', '$username', ".getProductId($productname).", '$quantity')";
            if ($conn -> query ( $query )) {                
                closeConnection ();
                return true;
            }            
        }
        }        		        	
}

//This function updates the quantity of a product given its name and the quantity.
function updateQuantity($productname, $quantity) {
    global $conn;
    $query = "update products set quantity=quantity-'$quantity' where product_name='$productname' ";
    if ($conn -> query ( $query )) {
        closeConnection ();
        return true;
            } 
}

//This function deletes a product from the cart of a user.
function deleteFromCart($username, $productname) {
    global $conn;
    $query = "delete from cart where username='$username' and product_id=".getProductId($productname);
    if ($conn -> query ( $query )) {
        closeConnection ();
        return true;
            } 
}

//This function adds the purchase history of a user to purchase_history table.
function addToPurchaseHistory($username, $product_id, $rating) {
    global $conn;
    $query = "insert into purchase_history values('$username', '$product_id', current_time(), '$rating')";
    if ($conn->query ( $query )) {
            return true;
    } else {
            return false;
    }
    closeConnection ();
}

//This function shows the cart of a user to the user.
function viewCart($username) {
        global $conn;        
	$query = "select * from cart where username='$username'";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
                echo "<form method='post' action='checkout.php'>";
		echo "<table border='1'><tr><th>Product Name</th><th>Quantity</th></tr>";
		while ( $row = $result -> fetch_assoc () ) {  
                    $name=getProductName($row ['product_id']);
			echo "<tr>".
                                "<td>". 
                                    $name.
                                "</td>".
                                "<td>" . 
                                    $row ['quantity'].
                                "</td>".
                                "<td>". 
                                "<input type='checkbox' name='product[]' value=".
                                    $name.
                                ">".
                                "</td>".
                                "<td>".
                                "<select name='rating[]'>".
                                "<option disabled selected value> -- select an option -- </option>".
                                "<option value=".$name."A>A</option>".
                                "<option value=".$name."B>B</option>".
                                "<option value=".$name."C>C</option>".
                                "<option value=".$name."D>D</option>".
                                "<option value=".$name."E>E</option>".
                                "</select>".
                                "</td>".
                              "</tr>";                                                                                                
		}		                
                echo "</table>";
                echo "<br>";
                echo "<button>Buy</button>";
                echo "</form>";
	} else {
		echo "You have not added anything to the cart yet.<br/>Kindly click <a href='../php/viewProducts.php'>here</a> to buy products</a>";
	}        
}
?>