<?php
// Include the database connection file
require_once 'database.php';

// Initialize the errors array
$errors = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $sports_category = $_POST["sports_category"];
    $tournament_name = $_POST["tournament_name"];
    $team_a = $_POST["team_a"];
    $team_b = $_POST["team_b"];
    $venue = $_POST["venue"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Validate the form data (you can add more validation as needed)
    if (empty($sports_category) || empty($tournament_name) || empty($team_a) || empty($team_b) || empty($venue) || empty($date) || empty($time)) {
        $errors[] = "All fields are required";
    }

    // If there are no errors, proceed to save the fixture
    if (empty($errors)) {
        try {
            // Save the fixture to the database
            $stmt = $conn->prepare("INSERT INTO fixtures (sports_category, tournament_name, team_a, team_b, venue, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $sports_category, $tournament_name, $team_a, $team_b, $venue, $date, $time);
            $stmt->execute();

            // Check if the fixture was successfully inserted
            if ($stmt->affected_rows > 0) {
                $success_message = "Fixture created successfully!";
            } else {
                $errors[] = "Failed to create fixture. Please try again later.";
            }

            // Close the prepared statement
            $stmt->close();
        } catch (Exception $e) {
            $errors[] = "Error: " . $e->getMessage();
        }
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
                <strong>Create Fixtures</strong>
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


<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6" style="background-color: #ffffff; border: 2px solid #dddddd; padding: 20px; border-radius: 10px;">
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
            <div class="form-header border"style="border:2px solid #ffffff; background-color:#44156a; color:#ffffff; margin-bottom:10px " ><h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;margin-top:5px">&nbsp;<span class="material-symbols-outlined">
            event_upcoming</span></h2></div>
            <form method="post" class="mt-4">
                <div class="form-group">
                    <label for="sports_category">Sports Category:</label>
                    <select class="form-control" name="sports_category" id="sports_category">
                        <option value="">Select Sports Category</option>
                        <option value="cricket">Cricket</option>
                        <option value="football">Football</option>
                        <option value="volleyball">Volleyball</option>
                        <option value="basketball">Basketball</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tournament_name">Tournament Name:</label>
                    <input type="text" class="form-control" name="tournament_name" id="tournament_name" required>
                </div>
                <div class="form-group">
                    <label for="team_a">Name of Team A:</label>
                    <input type="text" class="form-control" name="team_a" id="team_a" required>
                </div>
                <div class="form-group">
                    <label for="team_b">Name of Team B:</label>
                    <input type="text" class="form-control" name="team_b" id="team_b" required>
                </div>
                <div class="form-group">
                    <label for="venue">Venue:</label>
                    <input type="text" class="form-control" name="venue" id="venue" required>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" class="form-control" name="time" id="time" required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create Fixture</button>
                <a href="admin_fixtures.php" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View fixtures</a>
            </form>
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
<?php include_once"include\copywrite.php"; ?>

</body>
</html>
