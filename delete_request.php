<?php
// delete_request.php
require_once 'database.php';
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION["user"];

// Check if the request ID is provided via the URL
if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // Delete the request by ID if it belongs to the current user
    $sql = "DELETE FROM requests WHERE id = ? AND from_field = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $request_id, $user_name);
    
    if ($stmt->execute()) {
        echo "<div class='container mt-3'><div class='alert alert-success'>Request deleted successfully!</div></div>";
    } else {
        echo "<div class='container mt-3'><div class='alert alert-danger'>Failed to delete request.</div></div>";
    }
    
    $stmt->close();
}

// Redirect back to the requests view page
header("Location: my_request.php");
exit();
?>
