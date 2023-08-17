<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
   exit();
}
?>

<?php include_once"include/links.php"; ?>
<?php include_once"include/indexcss.php"; ?>
<?php $user_name = $_SESSION["user"];?> 

<body>
    <!-- Nav................................................................................Start -->
    <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary "> -->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> -->
    <nav class="navbar navbar-expand-lg " style=" background-image:linear-gradient(to right ,#44156a,blueviolet,blueviolet,white);">
  <div class="container-fluid" >
  <a class="navbar-brand" href="#">
      <img src="img/component1a.png" alt="Bootstrap" width="70" height="70">
    </a>
  <!-- <img src="img\component2.png" alt="" height="50" width="200"> -->

    <a class="navbar-brand" href="#" style="color:#ffffff;  margin-right:50px;font-size:xx-large;"> <strong> Sports Tracker</strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link "  href="log_register.php" style="margin-right:30px ;  font-size:large; ">Log Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link "  href="equipments.php" style="margin-right:30px ; font-size:large;">Equipments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="fixtures1.php" style="margin-right:30px ;font-size:large;">Fixtures</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="requests.php" style="margin-right:30px ;font-size:large;">Requests</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-right:30px ;font-size:large;">
            Teams
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cricket.php">Cricket</a></li>
            <li><a class="dropdown-item" href="football.php">Football</a></li>
            <li><a class="dropdown-item" href="volleyball.php">Volleyball</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link" href="notification.php" style="margin-right:30px ;font-size:large;">Notifications<span class="badge text-bg-danger" style="margin-bottom: 5px;">new</span></a>
        </li> -->
        <li class="nav-item dropdown">
        <a class="nav-link" href="notification.php" style="margin-right:30px; font-size:large;">Notifications<sup>
    <?php
    require_once 'database.php'; // Include your database connection

    // Check if there are new notifications
    $query = "SELECT COUNT(*) AS new_notifications FROM notifications1 WHERE is_new = 1";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $newNotifications = $row['new_notifications'];
  
    if ($newNotifications > 0) {
        echo '<span style="background-color:blueviolet;" class="badge  rounded-pill">New</span>';
    }
    
    ?>
    </sup>
</a>

</li>

      </ul>
      <div>
      <a id="button1" href="dashboard.php"  class="btn" style="background-color:darkorchid;"><span style="color: #ffffff;"><i class="fas fa-user"></i> </span></a>
  </div>
      <div style="margin-left: 50px;">
    <a class="btn btn-danger " href="logout.php"  ><i class="fas fa-sign-out-alt"> </i>Logout</a>
  </div>
  <a href="test.php" class="btn">test</a>
    </div>
  </div>
</nav>
<!-- Nav................................................................................end -->

<!-- carousel................................................................................Start -->
<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img\pngtree-sport-color-illustration-background-picture-image_2389053.jpg" class="d-block w-100" height="600" width="1200" alt="...">
     
      <div class="carousel-caption d-none d-md-block" >
        <h5 style="font-size: xx-large;"><b>WELCOME TO SPORTS TRACKER</b><br><?php echo $user_name; ?></h5>
      </div>
    </div>
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- carousel................................................................................end -->



 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
    $(document).ready(function() {
        // Assume the username variable holds the username of the logged-in user
        var username = "<?php echo isset($_SESSION["user"]) ? $_SESSION["user"] : ''; ?>"; // Get the username from PHP session

        // Function to hide buttons for non-admin users
        function hideButtonsForNonAdmin() {
            if (username === 'admin') {
                // Show the buttons for admin user
                $('#button1').show();
              
            } else {
                // Hide the buttons for non-admin users
                $('#button1').hide();
                
            }
        }

        // Call the function to hide buttons on page load
        hideButtonsForNonAdmin();
    });
</script>










<!-- cards................................................................................end -->

<br>
    
<!-- footer----------------------------->
<?php
include_once "include/footer.php";
?>
<!-- /footer----------------------------->
















</body>
</html>
