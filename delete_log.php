<?php
session_start();

// Include the database connection file
require_once 'database.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$log_id = $_GET["id"];


$sql = "DELETE FROM log_register WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $log_id);
$stmt->execute();
$stmt->close();

header("Location: admin_view_logs.php");
exit();
?>
