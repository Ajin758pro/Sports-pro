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
$sql = "SELECT *,DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date, TIME_FORMAT(time, '%H:%i') AS formatted_time FROM fixtures";
$result = $conn->query($sql);
$fixtures = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fixtures[] = $row;
    }
}

?>

<?php include_once"include/links.php"; ?>

<body style="background-image:linear-gradient(to bottom,#44156a,blueviolet,#44156a);">

<!-- navbar -->
<nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                <strong>Fixtures</strong>
            </span>
        </a>
        <form class="d-flex" role="search">
            <a class="btn " href="index.php" style="margin-right: 100px; background-image:linear-gradient(to right,#44156a,#44156a,blueviolet); color:#fff;">
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
        <div class="row">
            <?php foreach ($fixtures as $fixture): ?>
                <!-- <div class="col-md-5 mb-4">
                    <div class="card mt-4">
                        <div class="card-header">
                            <strong> VS </strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">Sports Category:</p>
                            
                            <p class="card-text"></p>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div> -->
                
<div class="card text-center" style="background-color:#ffffff; "> 
  <div class="card-header" style="background-image:linear-gradient(to right,#44156a,#44156a,blueviolet,#44156a); color:aliceblue; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:10px">
  <h4><?php echo $fixture['tournament_name']; ?></h4>
  </div>
  <div class="card-body">
  <div class="row">
  <div class="col-sm-2">
  </div>
  <div class="col-sm-3">
    <div class="card" style="background-color:orange">
      <div class="card-body">
        <h2 class="card-title"><?php echo $fixture['team_a']; ?></h2>
        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
      </div>
    </div>
  </div>
  <div class="col-sm-2">
    <h1 style="color:white">VS</h1>
  </div>
  
  <div class="col-sm-3">
    <div class="card" style="background-color:orangered">
      <div class="card-body">
        <h2 class="card-title"><?php echo $fixture['team_b']; ?></h2>
        </div>
    </div>
  </div>
</div>
  </div>
  <div class="col-sm-2">
  </div>
  <div class="card-footer text-body-secondary" style="background-color:gainsboro">
  <p class="card-text" style="color:black">
    <b>Venue: &nbsp;</b><?php echo $fixture['venue'];  ?>
   <br>
    <b>Date:</b>  <?php echo $fixture['formatted_date']; ?>
    &nbsp;
    <b>Time:</b> <?php echo $fixture['formatted_time']; ?> <!-- Updated line -->
 </p>
  </div>
</div>
<div>
    <br>
</div>
<?php 
//echo $fixture['sports_category']; 
?> 

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>




<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
