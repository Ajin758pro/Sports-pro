<?php include_once"include/links.php"; ?>

<body style="background-color:gainsboro">
    <!-- navbar -->
    <nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Teams</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn btn-secondary" href="dashboard.php" style="margin-right: 100px;">
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
    <!-- Your navbar code here -->

    <div class="container mt-4">
        <?php
        // database.php - include your database connection script here
        include "database.php";

        // Handle delete operation if "delete" parameter is present in the URL
        if (isset($_GET['delete'])) {
            $member_id = $_GET['delete'];
            // Perform the delete operation based on the member_id
            $delete_sql = "DELETE FROM team_members WHERE id = $member_id";
            if (mysqli_query($conn, $delete_sql)) {
                echo '<div class="alert alert-success mt-4">Team member deleted successfully!</div>';
            } else {
                echo '<div class="alert alert-danger mt-4">Error deleting team member: ' . mysqli_error($conn) . '</div>';
            }
        }

        // Retrieve team members from the database and sort by sports_category
        $sql = "SELECT * FROM team_members ORDER BY sports_category";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            ?>
            <table class="table table-bordered table-hover mt-4  text-center">
                <thead>
                    <tr>
                        <th style="background-color: #44156a; color:white;">#</th>
                        <th style="background-color: #44156a; color:white;">Name</th>
                        <th style="background-color: #44156a; color:white;">Age</th>
                        <th style="background-color: #44156a; color:white;">Department</th>
                        <th style="background-color: #44156a; color:white;">Sports Category</th>
                        <th style="background-color: #44156a; color:white;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $serial_number = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $serial_number; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['sports_category']; ?></td>
                            <td>
                                <!-- Delete button with confirmation -->
                                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this team member?')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php
                        $serial_number++;
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<p>No team members found.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>

    <!-- Include Bootstrap JS and other JS files if required -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
