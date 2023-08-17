<?php


// Include the database connection file
require_once 'database.php';



// Fetch all requests from the database
$sql = "SELECT * FROM requests ORDER BY date_created DESC, time_created DESC";
$result = $conn->query($sql);

// Check if there are any requests
$requests = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requests</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body style="background-color:gainsboro">
    <!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong> Requests</strong>
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
    
    
    <!-- ... (navbar code) ... -->

    <div class="container mt-4">
        <div class="row">
            <?php if (empty($requests)): ?>
                <div class="col-md-12">
                    <div class="alert alert-info">
                        No requests found.
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($requests as $request): ?>
                    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-4">
                        <div class="card ">
                            <div class="card-body border">
                               
                               <!-- <h5 class="card-title">Request ID: </h5> -->
                                <p class="card-text" style="color: #44156a;">From:<strong><?php echo $request['from_field']; ?></strong></p>
                                <p class="card-text">Department:<?php echo $request['department']; ?> </p>
                                <p class="card-text">Subject: <?php echo $request['subject']; ?> </p>
                                </div>
                                <div class="card-header border" style="background-color: #44156a; color:#ffffff">
                                <p class="card-text-justify" ><?php echo $request['description']; ?></p>
                               </div>
                                
                                <div class="card-text  text-end border"><pre class="card-text">Date:<?php echo $request['date_created']; ?> Time:<?php echo $request['time_created']; ?></pre></div>
                           
                        </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include_once"include\copywrite.php"; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
