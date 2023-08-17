<?php include_once"include/links.php"; ?>
<body style="background-color:gainsboro">
    <!-- navbar -->
    <nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
        <div class="container-fluid">
            <a class="navbar-brand">
                <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                    <strong>Add Team Members</strong>
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
            <div class="col-md-6">
                <?php
                // Include the database connection file
                require_once 'database.php';

                // Initialize the errors array and success message
                $errors = array();
                $success_message = '';

                // Check if the form is submitted
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    // Get the form data
                    $name = $_POST["name"];
                    $age = $_POST["age"];
                    $department = $_POST["department"];
                    $sports_category = $_POST["sports_category"];

                    // Validate the form data (you can add more validation as needed)
                    if (empty($name) || empty($age) || empty($department) || empty($sports_category)) {
                        $errors[] = "All fields are required";
                    }

                    // If there are no errors, proceed to save the team member details
                    if (empty($errors)) {
                        try {
                            // Save the team member details to the database
                            $stmt = $conn->prepare("INSERT INTO team_members (name, age, department, sports_category) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("siss", $name, $age, $department, $sports_category);
                            $stmt->execute();

                            // Check if the team member details were successfully inserted
                            if ($stmt->affected_rows > 0) {
                                $success_message = "Team member details inserted successfully!";
                            } else {
                                $errors[] = "Failed to insert team member details. Please try again later.";
                            }

                            // Close the prepared statement
                            $stmt->close();
                        } catch (Exception $e) {
                            $errors[] = "Error: " . $e->getMessage();
                        }
                    }
                }
                ?>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger mt-4">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success mt-4"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div style="background-color: #ffffff; border: 2px solid #dddddd; padding: 40px; border-radius: 10px;">
            <div class="compose-form">
                <div class="form-header border"style="border:2px solid #ffffff; background-color:#44156a; color:#ffffff; margin-bottom:10px " ><h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;margin-top:5px">&nbsp;<span class="material-symbols-outlined">
                person_add
        </span></h2></div>  
            <form method="post" class="mt-4">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" name="age" id="age" min="18" max="28" required>
                    </div>

                    <div class="form-group">
                        <label for="department">Department:</label>
                        <select class="form-control" name="department" id="department" required>
                            <option value="">Select Department</option>
                            <option value="MCA">MCA</option>
                            <option value="MBA">MBA</option>
                            <option value="BIO">BIO</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sports_category">Sports Category:</label>
                        <select class="form-control" name="sports_category" id="sports_category" required>
                            <option value="">Select Sports Category</option>
                            <option value="Cricket">Cricket</option>
                            <option value="Football">Football</option>
                            <option value="Volleyball">Volleyball</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Member</button>
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
</body>
</html>
