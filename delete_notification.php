<?php
// Include the database connection file
require_once 'database.php';

// Check if the notification ID is provided in the URL
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$notification_id = $_GET["id"];

// Delete the notification from the database
$sql = "DELETE FROM notifications1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $notification_id);
$stmt->execute();
$stmt->close();

// Redirect to the notification list page after deletion
header("Location: admin_notification.php");
exit();
?>
