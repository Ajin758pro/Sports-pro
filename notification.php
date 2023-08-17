<?php
// Include the database connection file
require_once 'database.php';

// Retrieve notifications from the database
$sql = "SELECT *, DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date, TIME_FORMAT(time, '%H:%i') AS formatted_time FROM notifications1 ORDER BY date DESC, time DESC";
$result = $conn->query($sql);

// Initialize an empty array to store notifications
$notifications = array();

if ($result->num_rows > 0) {
    // Fetch all rows and store them in the $notifications array
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
        
        // Mark the notification as read (is_new = 0)
        $updateQuery = "UPDATE notifications1 SET is_new = 0 WHERE id = " . $row['id'];
        $conn->query($updateQuery);
    }
}

// Close the database connection
$conn->close();
?>

<!-- Rest of your HTML and PHP code for displaying notifications -->

<?php include_once"include/links.php"; ?>

<body  style="background-color:black;">

<!-- navbar -->
<nav class="navbar " style="padding-top: 20px; padding-bottom: 20px;background-color:#fff">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Notifications</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn" href="index.php" style="margin-right: 100px; background-image:linear-gradient(to right,#44156a,#44156a,blueviolet); color:#fff;" >
                <span style="color:white;"><i class="fa fa-arrow-left"></i> Back</span>
            </a>
        </form>
    </div>
</nav>
<!-- /navbar -->

<div class="container mt-4">
    <?php foreach ($notifications as $notification): ?>
        <div class="container">
            <div class="card" >
                <div class="card-body" style="background-image:linear-gradient(to bottom,#44156a,#44156a,blueviolet); margin:5px "  >
                    <p style="color:#ffffff;"> 
                        <?php echo $notification['description']; ?>
                    </p>
                </div>
                <div class="rounded-pill"  style="  margin-bottom:5px; margin-top:5px; margin-left:5px; height:24px; width:fit-content; background-image:linear-gradient(to bottom,#44156a,#44156a,blueviolet); color:#fff;">
                    <p style="font-size: small;"> 
                    &nbsp; Date:<?php echo $notification['formatted_date']; ?>&nbsp; &nbsp;Time:<?php echo $notification['formatted_time'];?>&nbsp;&nbsp;
                    </p>
                </div>
                
            </div>
        </div>
        <div><br></div>
    <?php endforeach; ?>
    
</div>
<!-- Include Bootstrap JS and jQuery (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

