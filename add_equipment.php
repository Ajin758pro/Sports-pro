<?php
// database.php
require_once 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are filled
    if (
        isset($_POST["equipment_name"]) &&
        isset($_POST["numbers"]) &&
        isset($_POST["sports_category"])
    ) {
        $equipment_name = $_POST["equipment_name"];
        $numbers = $_POST["numbers"];
        $sports_category = $_POST["sports_category"];

        // Handle the uploaded image file
        if (isset($_FILES["equipment_image"])) {
            $file_name = $_FILES["equipment_image"]["name"];
            $file_tmp = $_FILES["equipment_image"]["tmp_name"];
            $file_type = $_FILES["equipment_image"]["type"];
            $file_size = $_FILES["equipment_image"]["size"];

            // Move the uploaded file to a target location
            $target_directory = "uploads/";
            $target_file = $target_directory . basename($file_name);

            // Check if the file is an image
            $allowed_image_types = array("image/jpeg", "image/png", "image/gif");
            if (in_array($file_type, $allowed_image_types)) {
                if (move_uploaded_file($file_tmp, $target_file)) {
                    // Insert the data into the database
                    $sql = "INSERT INTO sports_equipment (equipment_name, numbers, sports_category, equipment_image)
                            VALUES ('$equipment_name', '$numbers', '$sports_category', '$target_file')";

                    if (mysqli_query($conn, $sql)) {
                        $success_message = "Equipment details added successfully!";
                    } else {
                        $errors[] = "Error: " . mysqli_error($conn);
                    }
                } else {
                    $errors[] = "Failed to upload image.";
                }
            } else {
                $errors[] = "Invalid image format. Allowed formats are JPEG, PNG, and GIF.";
            }
        } else {
            $errors[] = "Equipment image is required.";
        }
    } else {
        $errors[] = "All fields are required.";
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
                <strong>Add Equipments</strong>
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
        <div class="col-md-6">
            
            <div style="background-color: #ffffff; border: 2px solid #dddddd; padding: 20px; border-radius: 10px;">
              
                <div class="compose-form">
                <div class="form-header border"style="border:2px solid #ffffff; background-color:#44156a; color:#ffffff; margin-bottom:10px " ><h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;margin-top:5px">&nbsp;<span class="material-symbols-outlined">
                add_box
        </span></h2></div>
          <!-- Alert message div -->
          <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
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
                <?php endif; ?>
                <!-- End of Alert message div -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="equipment_name">Equipment Name:</label>
                        <input type="text" class="form-control" name="equipment_name" id="equipment_name" required>
                    </div>

                    <div class="form-group">
                        <label for="numbers">Numbers:</label>
                        <input type="number" class="form-control" name="numbers" id="numbers" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="sports_category">Sports Category:</label>
                        <select class="form-control" name="sports_category" id="sports_category" required>
                            <option value="">Select Sports Category</option>
                            <option value="Cricket">Cricket</option>
                            <option value="Football">Football</option>
                            <option value="Volleyball">Volleyball</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="equipment_image">Equipment Image:</label>
                        <input type="file" class="form-control-file" name="equipment_image" id="equipment_image" required>
                    </div><br>

                    <button type="submit" id="btn1" class="btn ">Add Equipment</button>
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
