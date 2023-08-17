<?php
//database.php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "sportstracker";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>