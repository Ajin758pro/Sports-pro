<?php
// Include the database connection file
require_once 'database.php';

// Check if fixture ID is provided in the URL
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: admin_view_fixtures.php");
    exit();
}

$fixture_id = $_GET["id"];

// Fetch the fixture details from the database
$sql = "SELECT * FROM fixtures WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $fixture_id);
$stmt->execute();
$result = $stmt->get_result();
$fixture = $result->fetch_assoc();
$stmt->close();

// Check if the fixture ID is valid and exists in the database
if (!$fixture) {
    header("Location: admin_view_fixtures.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the updated details from the form
    $sports_category = $_POST["sports_category"];
    $tournament_name = $_POST["tournament_name"];
    $team_a = $_POST["team_a"];
    $team_b = $_POST["team_b"];
    $venue = $_POST["venue"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Update the fixture details in the database
    $sql = "UPDATE fixtures SET sports_category = ?, tournament_name = ?, team_a = ?, team_b = ?, venue = ?, date = ?, time = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $sports_category, $tournament_name, $team_a, $team_b, $venue, $date, $time, $fixture_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to the view fixtures page after successful update
    header("Location: admin_fixtures.php");
    exit();
}
?>

<?php include_once"include/links.php"; ?>

<body>

<!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Edit Fixtures</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn btn-secondary" href="admin_fixtures.php" style="margin-right: 100px;">
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
<!-- /navbar -->

<div class="container mt-4">
    <form method="post">
        <div class="form-group">
            <label for="sports_category">Sports Category:</label>
            <select class="form-control" name="sports_category" id="sports_category">
                <option value="Cricket" <?php echo ($fixture['sports_category'] === 'Cricket') ? 'selected' : ''; ?>>Cricket</option>
                <option value="Football" <?php echo ($fixture['sports_category'] === 'Football') ? 'selected' : ''; ?>>Football</option>
                <option value="Volleyball" <?php echo ($fixture['sports_category'] === 'Volleyball') ? 'selected' : ''; ?>>Volleyball</option>
                <option value="Basketball" <?php echo ($fixture['sports_category'] === 'Basketball') ? 'selected' : ''; ?>>Basketball</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tournament_name">Tournament Name:</label>
            <input type="text" class="form-control" name="tournament_name" id="tournament_name" value="<?php echo $fixture['tournament_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="team_a">Team A:</label>
            <input type="text" class="form-control" name="team_a" id="team_a" value="<?php echo $fixture['team_a']; ?>" required>
        </div>
        <div class="form-group">
            <label for="team_b">Team B:</label>
            <input type="text" class="form-control" name="team_b" id="team_b" value="<?php echo $fixture['team_b']; ?>" required>
        </div>
        <div class="form-group">
            <label for="venue">Venue:</label>
            <input type="text" class="form-control" name="venue" id="venue" value="<?php echo $fixture['venue']; ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" name="date" id="date" value="<?php echo $fixture['date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" class="form-control" name="time" id="time" value="<?php echo $fixture['time']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
