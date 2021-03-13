<?php
session_start();
include 'dbOperations.php';

if(!empty($_POST['product'])) {
    for ($index = 0; $index < count($_POST['product']); $index++) {
        $rating=substr($_POST['rating'][$index],0,strlen($_POST['rating'][$index])-1);
        if (!empty($_POST['rating'][$index]) && $rating==$_POST['product'][$index]) {
            if(addToPurchaseHistory($_SESSION['username'], getProductId($_POST['product'][$index]), $rating)) {
                echo 'You have bought the product '.$_POST['product'][$index]. ' successfully. Thank You!!!';                
            }
        }
        else {
            echo '<br>';
            echo 'Please rate products '.$_POST['product'][$index].' to buy';
            break;
        }
}
}
?>

