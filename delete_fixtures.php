<?php
// Include the database connection file
require_once 'database.php';

// Check if fixture ID is provided in the URL
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location:admin_fixtures.php");
    exit();
}

$fixture_id = $_GET["id"];

// Delete the fixture from the database
$sql = "DELETE FROM fixtures WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $fixture_id);
$stmt->execute();
$stmt->close();

// Redirect to the view fixtures page after deletion
header("Location:admin_fixtures.php ");
exit();
?>
