<?php
session_start();
include 'dbOperations.php';
echo viewCart($_SESSION['username']);
?>