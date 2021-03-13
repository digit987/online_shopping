<?php
session_start();
include 'dbOperations.php';
echo "<form method='post' action='../php/logOut.php' align='right'>".
            "<button>Log Out</button>".
            "</form>";
allUsersPurchaseHistory();
?>