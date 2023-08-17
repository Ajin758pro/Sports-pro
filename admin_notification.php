<?php
// Include the database connection file
require_once 'database.php';

// Retrieve notifications from the database
$sql = "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date, TIME_FORMAT(time, '%H:%i') AS formatted_time FROM notifications1 ORDER BY date DESC, time DESC";
$result = $conn->query($sql);

// Initialize an empty array to store notifications
$notifications = array();

if ($result->num_rows > 0) {
    // Fetch all rows and store them in the $notifications array
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Close the database connection
$conn->close();

?>

<?php include_once"include/links.php"; ?>
<body style="background-color:gainsboro">

<!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Admin_View Notifications</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn btn-secondary" href="dashboard.php" style="margin-right: 100px;">
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
<!-- /navbar -->
<br>
<!-- <div class="d-grid gap-2 col-2 mx-auto">
  <a href="create_notification.php" class="btn btn-outline-warning"><b style="color: #44156a;">Create</b></a>
</div> -->
<div class="container mt-4">
    <?php if (empty($notifications)): ?>
        <div class="alert alert-info mt-4">
            No notifications found.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover mt-4  text-center">
            <thead class="thead-dark" >
                <tr>
                    <th style="background-color: #44156a; color:white;width:100px; " >Date</th>
                    <th  style="background-color: #44156a; color:white; width:100px; ">Time</th>
                    <th  style="background-color: #44156a; color:white; width:400px; ">Description</th>
                    <th  style="background-color: #44156a; color:white; width:100px;">Edit</th>
                    <th  style="background-color: #44156a; color:white; width:100px;">Delete </th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notifications as $notification): ?>
                    <tr>
                        <td><?php echo $notification['formatted_date']; ?></td> <!-- Updated line -->
                        <td><?php echo $notification['formatted_time']; ?></td> <!-- Updated line -->
                        <td><?php echo $notification['description']; ?></td>
                        <td>
                            <a href="edit_notification.php?id=<?php echo $notification['id']; ?>" class="btn btn-success"><i class="fa fa-cogs"></i> Edit</a>
                        </td>
                        <td>
                            <a href="delete_notification.php?id=<?php echo $notification['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this notification?')"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Include Bootstrap JS and jQuery (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
