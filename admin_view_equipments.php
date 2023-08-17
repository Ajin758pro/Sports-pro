<?php
// database.php
require_once 'database.php';

// Fetch sports equipment details from the database
$sql = "SELECT * FROM sports_equipment ORDER BY sports_category";
$result = mysqli_query($conn, $sql);

// Function to delete equipment by ID
function deleteEquipment($equipment_id)
{
    global $conn;
    $sql = "DELETE FROM sports_equipment WHERE equipment_id = '$equipment_id'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
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
                <strong>Admin_View Equipments</strong>
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- <h2 class="text-center">Admin - View Sports Equipment Details</h2> -->
            <!-- ... Existing PHP code ... -->

<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th style="background-color: #44156a; color:white; ">#</th>
            <th style="background-color: #44156a; color:white; ">Equipment Name</th>
            <th style="background-color: #44156a; color:white; ">Numbers</th>
            <th style="background-color: #44156a; color:white; ">Sports Category</th>
            <th style="background-color: #44156a; color:white; ">Equipment Image</th>
            <th style="background-color: #44156a; color:white; ">Action</th>
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
            echo "<td>
                    <a href='edit_equipment.php?id=" . $row['equipment_id'] . "' class='btn btn-success'>
                        <i class='fa fa-edit'></i> Edit
                    </a>
                    <a href='delete_equipment.php?id=" . $row['equipment_id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this equipment?\")'>
                        <i class='fa fa-trash'></i> Delete
                    </a>
                </td>";
            echo "</tr>";
            $serial_number++;
        }
        ?>
    </tbody>
</table>

<!-- ... Existing HTML code ... -->

            </div>
        </div>
    </div>

    <!-- Add the Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
