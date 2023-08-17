<?php include_once"include/links.php"; ?>
<body style="background-color:gainsboro">
    <!-- navbar -->
    <nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Cricket Team</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn " href="index.php" style="margin-right: 100px; background-image:linear-gradient(to right,#44156a,blueviolet); color:#fff;">
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

        // Retrieve cricket team members from the database based on sports_category "Cricket"
        $sql = "SELECT * FROM team_members WHERE sports_category = 'Cricket'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            ?>
            <table class="table table-bordered table-hover mt-4  text-center">
                <thead>
                    <tr>
                        <th style="background-color: #44156a; color:white; ">#</th>
                        <th style="background-color: #44156a; color:white; ">Name</th>
                        <th style="background-color: #44156a; color:white; ">Age</th>
                        <th style="background-color: #44156a; color:white; ">Department</th>
                        <!-- <th>Sports Category</th> -->
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
                           
                        </tr>
                        <?php
                        $serial_number++;
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<p>No cricket team members found.</p>";
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
