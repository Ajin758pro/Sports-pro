<?php
// Include the database connection file
require_once 'database.php';

// Fetch fixtures from the database
// $sql = "SELECT * FROM fixtures";
// $result = $conn->query($sql);
// $fixtures = [];

// if ($result && $result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $fixtures[] = $row;
//     }
// }
// Fetch fixtures from the database
$sql = "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date, TIME_FORMAT(time, '%H:%i') AS formatted_time FROM fixtures";
$result = $conn->query($sql);
$fixtures = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fixtures[] = $row;
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
                <strong>Admin_View Fixtures</strong>
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
    <?php if (empty($fixtures)): ?>
        <div class="alert alert-info mt-4">
            No fixtures found.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover mt-4 text-center">
            <thead class="thead-dark">
                <tr>
                    <th style="background-color: #44156a; color:white; ">Sports Category</th>
                    <th style="background-color: #44156a; color:white; ">Tournament Name</th>
                    <th style="background-color: #44156a; color:white; ">Team A</th>
                    <th style="background-color: #44156a; color:white; ">Team B</th>
                    <th style="background-color: #44156a; color:white; ">Venue</th>
                    <th style="background-color: #44156a; color:white; ">Date</th>
                    <th style="background-color: #44156a; color:white; ">Time</th>
                    <th style="background-color: #44156a; color:white; ">Edit</th>
                    <th style="background-color: #44156a; color:white; ">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fixtures as $fixture): ?>
                    <tr>
                        <td><?php echo $fixture['sports_category']; ?></td>
                        <td><?php echo $fixture['tournament_name']; ?></td>
                        <td><?php echo $fixture['team_a']; ?></td>
                        <td><?php echo $fixture['team_b']; ?></td>
                        <td><?php echo $fixture['venue']; ?></td>
                        <td><?php echo $fixture['formatted_date']; ?></td> <!-- Updated line -->
                        <td><?php echo $fixture['formatted_time']; ?></td> <!-- Updated line -->
                        <td>
                            <a href="edit_fixtures.php?id=<?php echo $fixture['id']; ?>" class="btn btn-success"><i class="fa fa-cogs"></i> Edit</a>
                        </td>
                        <td>
                            <a href="delete_fixtures.php?id=<?php echo $fixture['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this fixture?')"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
