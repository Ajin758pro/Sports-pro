<?php
// edit_equipment.php
require_once 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are filled
    if (
        isset($_POST["equipment_name"]) &&
        isset($_POST["numbers"]) &&
        isset($_POST["sports_category"]) &&
        isset($_POST["equipment_id"])
    ) {
        $equipment_id = $_POST["equipment_id"];
        $equipment_name = $_POST["equipment_name"];
        $numbers = $_POST["numbers"];
        $sports_category = $_POST["sports_category"];

        // Update the equipment details in the database
        $sql = "UPDATE sports_equipment SET equipment_name='$equipment_name', numbers='$numbers', sports_category='$sports_category' WHERE equipment_id='$equipment_id'";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='container mt-3'><div class='alert alert-success'>Equipment details updated successfully!</div></div>";
        } else {
            echo "<div class='container mt-3'><div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div></div>";
        }
    } else {
        echo "<div class='container mt-3'><div class='alert alert-danger'>All fields are required.</div></div>";
    }
} else {
    // Fetch equipment details from the database based on the equipment ID
    if (isset($_GET['id'])) {
        $equipment_id = $_GET['id'];
        $sql = "SELECT * FROM sports_equipment WHERE equipment_id='$equipment_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $equipment_name = $row['equipment_name'];
            $numbers = $row['numbers'];
            $sports_category = $row['sports_category'];
            
        } else {
            // Redirect to the equipment view page if the equipment is not found
            header("Location: admin_view_equipment.php");
            exit();
        }
    } else {
        // Redirect to the equipment view page if equipment ID is not provided
        header("Location: admin_view_equipment.php");
        exit();
    }
}
?>

<?php include_once"include/links.php"; ?>
<body style="background-color: gainsboro;">
    <!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Edit Equipment</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn btn-secondary" href="admin_view_equipments.php" style="margin-right: 100px;">
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
<!-- /navbar -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div style="background-color: #ffffff; border: 2px solid #dddddd; padding: 20px; border-radius: 10px;">
                    <!-- <h2 class="text-center">Edit Sports Equipment</h2> -->
                    <form method="post">
                        <input type="hidden" name="equipment_id" value="<?php echo $equipment_id; ?>">
                        <div class="form-group">
                            <label for="equipment_name">Equipment Name:</label>
                            <input type="text" class="form-control" name="equipment_name" id="equipment_name" value="<?php echo $equipment_name; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="numbers">Numbers:</label>
                            <input type="number" class="form-control" name="numbers" id="numbers" min="1" value="<?php echo $numbers; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="sports_category">Sports Category:</label>
                            <select class="form-control" name="sports_category" id="sports_category" required>
                                <option value="">Select Sports Category</option>
                                <option value="Cricket" <?php if ($sports_category === 'Cricket') echo 'selected'; ?>>Cricket</option>
                                <option value="Football" <?php if ($sports_category === 'Football') echo 'selected'; ?>>Football</option>
                                <option value="Volleyball" <?php if ($sports_category === 'Volleyball') echo 'selected'; ?>>Volleyball</option>
                                <option value="Basketball" <?php if ($sports_category === 'Basketball') echo 'selected'; ?>>Basketball</option>
                                <option value="Others" <?php if ($sports_category === 'Others') echo 'selected'; ?>>Others</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update Equipment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Function to hide the alert after 2 seconds
        function hideAlert() {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.remove();
                }, 1000); // 2 seconds (2000 milliseconds)
            }
        }

        // Call the hideAlert function when the page is loaded
        document.addEventListener('DOMContentLoaded', hideAlert);
    </script>
    <!-- Include Bootstrap JS and other JS files if required -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add the Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
