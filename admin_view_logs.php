<?php
session_start();

// Include the database connection file
require_once 'database.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Check if the user is an admin (you can adjust this based on your authentication logic)
$is_admin = ($_SESSION["user"] === "admin"); // Replace "admin" with your admin username

// Fetch data from the log_register table, ordered by the id in descending order (latest first)
$sql = "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date, TIME_FORMAT(time, '%H:%i') AS formatted_time FROM log_register ORDER BY id DESC";
$result = $conn->query($sql);
$log_records = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $log_records[] = $row;
    }
}

?>



<?php include_once"include/links.php"; ?>

<body style="background-color:gainsboro">

<!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Log Register</strong>
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
    <div class="container mt-4">
        <?php if ($is_admin): ?>
            <table class="table table-bordered table-hover mt-4  text-center">
                <thead class="thead-dark">
                <tr>
                    <th style="background-color: #44156a; color:white; ">Name</th>
                    <th style="background-color: #44156a;  color:white;">Department</th>
                    <th style="background-color: #44156a;  color:white;">Date</th>
                    <th style="background-color: #44156a;  color:white;">Time</th>
                    <th style="background-color: #44156a;  color:white;">Sports Category</th>
                    <th style="background-color: #44156a;  color:white;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($log_records as $record): ?>
                    <tr>
                        <td><?php echo $record['name']; ?></td>
                        <td><?php echo $record['department']; ?></td>
                        <td><?php echo $record['formatted_date']; ?></td> <!-- Updated line -->
                        <td><?php echo $record['formatted_time']; ?></td> <!-- Updated line -->
                        <td><?php echo $record['sports_category']; ?></td>
                        <td >
                            <a href="delete_log.php?id=<?php echo $record['id']; ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this log entry?')"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-danger mt-4">You are not authorized to access this page.</div>
        <?php endif; ?>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
