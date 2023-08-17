<?php
// Include the database connection file
require_once 'database.php';

// Fetch user details from the database excluding user with name 'admin'
$sql = "SELECT * FROM users WHERE name != 'admin'";
$result = $conn->query($sql);
$users = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Process the delete user request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $delete_id);
    $delete_stmt->execute();
    $delete_stmt->close();

    // Redirect to the view users page after deletion
    header("Location: users.php");
    exit();
}
?>


<?php include_once"include/links.php"; ?>

<body style="background-color:gainsboro">

<!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Users</strong>
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
<div class="row justify-content-center">
    <?php if (empty($users)): ?>
        <div class="alert alert-info mt-4">
            No users found.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover mt-4 text-center">
            <thead class="thead-dark">
                <tr>
                    <th style="background-color: #44156a; color:white;">Name</th>
                    <th style="background-color: #44156a; color:white;">Department</th>
                    <th style="background-color: #44156a; color:white;">Email</th>
                    <th style="background-color: #44156a; color:white;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['department']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="?delete_id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i> Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
    </div>

</body>
</html>
