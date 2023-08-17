<?php
// Include the database connection file
require_once 'database.php';

// Check if the notification ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: view_notifications.php");
    exit();
}

$notification_id = $_GET['id'];

// Retrieve the notification details from the database based on the provided ID
$sql = "SELECT * FROM notifications1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $notification_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // No notification found with the provided ID, redirect to view_notifications.php
    $stmt->close();
    header("Location: view_notifications.php");
    exit();
}

$notification = $result->fetch_assoc();
$stmt->close();

// Initialize the errors array
$errors = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated notification description from the form
    $description = $_POST["description"];

    // Validate the notification description
    if (empty($description)) {
        $errors[] = "Description is required";
    }

    // If there are no errors, proceed to update the notification
    if (empty($errors)) {
        try {
            // Update the notification in the database
            $sql = "UPDATE notifications1 SET description = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $description, $notification_id);
            $stmt->execute();

            // Check if the notification was successfully updated
            if ($stmt->affected_rows > 0) {
                $success_message = "Notification updated successfully!";
            } else {
                $errors[] = "Failed to update notification. Please try again later.";
            }

            // Close the prepared statement
            $stmt->close();
        } catch (Exception $e) {
            $errors[] = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Notification</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Edit Notification</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn btn-secondary" href="admin_notification.php" style="margin-right: 100px;">
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
<!-- /navbar -->

<div class="container mt-4">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger mt-4">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success mt-4"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form method="post" class="mt-4">
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="4" style="width: 650px;"><?php echo $notification['description']; ?></textarea>
        </div>

        <button type="submit"  class="btn btn-primary">Update Notification</button>
    </form>
</div>

<!-- Include Bootstrap JS and jQuery (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
