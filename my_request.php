<?php
require_once 'database.php';
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION["user"];

// Retrieve the user's requests from the database
$sql = "SELECT *,DATE_FORMAT(date_created, '%d-%m-%Y') AS formatted_date, TIME_FORMAT(time_created, '%H:%i') AS formatted_time FROM requests WHERE from_field = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();
$requests = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Requests</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        /* ... Custom styles ... */
    </style>
</head>
<body style="background-image:linear-gradient(to bottom,#44156a,#44156a,blueviolet,blueviolet,#44156a);">

    <!-- ... Navbar code ... -->
    <!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>My Requests</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn " href="requests.php" style="margin-right: 100px; background-image:linear-gradient(to right,#44156a,#44156a,blueviolet); color:#fff;">
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
<!-- /navbar -->

    
    <!-- ... Custom JavaScript ... -->
    <div class="container mt-4">
    <?php if (empty($requests)): ?>
        <div class="alert alert-info mt-4">
            No Requests found.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    
                    <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white;width:100px; ">Date</th>
                    <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; width:100px; ">Time</th>
                    <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; width: 250px; ">Subject</th>
                    <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white;width: 450px; ">Description</th>
                    <!-- <th style="background-color: #44156a; color:white; ">Edit</th> -->
                    <th style="background-image:linear-gradient(to bottom,#44156a,blueviolet); color:white; width:100px; ">Delete</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                                   
                                    <td><?php echo $request['formatted_date']; ?></td>
                                    <td><?php echo $request['formatted_time']; ?></td>
                                    <td><?php echo $request['subject']; ?></td>
                                    <td><?php echo $request['description']; ?></td>
                        <!-- <td>
                            <a href="edit_request.php?id=<?php //echo $request['id']; ?>" class="btn btn-success"><i class="fa fa-cogs"></i> Edit</a>
                        </td> -->
                        <td>
                            <a  href="delete_request.php?id=<?php echo $request['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this fixture?')"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
