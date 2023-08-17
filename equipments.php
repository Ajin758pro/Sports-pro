<?php
// database.php
require_once 'database.php';

// Fetch sports equipment details from the database and sort by sports category
$sql = "SELECT * FROM sports_equipment ORDER BY sports_category";
$result = mysqli_query($conn, $sql);
?>

<?php include_once"include/links.php"; ?>

<body style="background-image:linear-gradient(to bottom,#44156a,#44156a,blueviolet,blueviolet,#44156a);">
     <!-- navbar -->
     <nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Equipments</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn " href="index.php" style="margin-right: 100px; background-image:linear-gradient(to right,#44156a,blueviolet); color:#fff;">
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-bordered  text-center">
                    <thead>
                        <tr>
                            <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; ">#</th>
                            <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; ">Equipment Name</th>
                            <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; ">Numbers</th>
                            <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; ">Sports Category</th>
                            <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; ">Equipment Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through the rows and display the data in the table
                        $serial_number = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $serial_number . "</td>";
                            echo "<td>" . $row['equipment_name'] . "</td>";
                            echo "<td>" . $row['numbers'] . "</td>";
                            echo "<td>" . $row['sports_category'] . "</td>";
                            echo "<td><img src='" . $row['equipment_image'] . "' height='100' alt='Equipment Image'></td>";
                            echo "</tr>";
                            $serial_number++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add the Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
