<?php
session_start();

// Include the database connection file
require_once 'database.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION["user"];
//mycode
$department_sql = "SELECT department FROM users WHERE name = ?";
$department_stmt = $conn->prepare($department_sql);
$department_stmt->bind_param("s", $user_name);
$department_stmt->execute();
$department_result = $department_stmt->get_result();
$department_data = $department_result->fetch_assoc();

$user_department = $department_data["department"];

//my code end=====

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process the log registration form data
    //$department = $_POST["department"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $sports_category = $_POST["sports_category"];

    // Insert the log into the database
    $sql = "INSERT INTO log_register (name, department, date, time, sports_category) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    //$stmt->bind_param("sssss", $user_name, $department, $date, $time, $sports_category);
    $stmt->bind_param("sssss", $user_name, $user_department, $date, $time, $sports_category);
    $stmt->execute();
     
    $department_stmt->close();
    // Close the prepared statement
    $stmt->close();
    
    // Display success message
    $success_message = "Log registered successfully!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="index.css"> -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    
   


    
<style>
    .form-container {
        background-color: #ffffff;
        border: 2px solid #dddddd;
        padding: 20px;
        border-radius: 10px;
    }
    .alert{
                
                padding:8px;
                
              }
              #btn1{
         
         background-color:blueviolet;
         color: white;
       }
       #btn1:hover{
         background-color: #44156a;
         color: white;
       }
</style>
</head>
<body style="background-image:linear-gradient(to bottom,#44156a,#44156a,blueviolet,blueviolet,#44156a);">
  <!-- navbar -->
  <nav class="navbar bg-body-tertiary" style="padding-top: 20px; padding-bottom: 20px;">
  <div class="container-fluid">
    <a class="navbar-brand"><span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif "><strong>Log Register</strong></span></a>
    <form class="d-flex" role="search">
      <a class="btn btn-secondary" href="index.php" style="margin-right: 100px; background-image:linear-gradient(to right,#44156a,blueviolet); color:#fff;" ><span style="color:white;"><i class="fa fa-arrow-left"></i> &nbsp; back</span></a>
    </form>
  </div>
</nav>
<!-- /navbar -->

<!-- form -->



<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
          
            <div class="form-container">
                <div class="form-header border" style="border: 2px solid #ffffff; background-image:linear-gradient(to right,#44156a,#44156a,blueviolet,white); color: #ffffff; margin-bottom: 10px;">
                    <h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; margin-top: 5px;">
                        &nbsp;<span class="material-symbols-outlined">demography</span>
                    </h2>
                </div>
                <?php if (isset($success_message)): ?>
                <div id="successMessage" class="alert alert-success mt-4"><?php echo $success_message; ?></div>
            <?php endif; ?>
                <form method="post" class="mt-4">
                <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" value="<?php echo $user_name; ?>" readonly>
            </div>
            <?php
            // Set default value for $department
            $department = '';
            ?>
            <div class="form-group">
                <label for="department">Department:</label>
                <!-- <select class="form-control" name="department" id="department" required>
                    <option value="">Select Department</option>
                    <option value="MCA" <?php //echo ($department === 'MCA') ? 'selected' : ''; ?>>MCA</option>
                    <option value="MBA" <?php //echo ($department === 'MBA') ? 'selected' : ''; ?>>MBA</option>
                    <option value="BIO" <?php //echo ($department === 'BIO') ? 'selected' : ''; ?>>BIO</option>
                </select> -->
                <input type="text" class="form-control" id="name" value="<?php echo  $user_department; ?>" readonly>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">Time:</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>
                </div>
            <?php
            $sports_category = '';
            ?>
            <div class="form-group">
                <label for="sports_category">Sports Category:</label>
                <select class="form-control" name="sports_category" id="sports_category" required>
                    <option value="">Select Sports Category</option>
                    <option value="cricket" <?php echo ($sports_category === 'cricket') ? 'selected' : ''; ?>>Cricket</option>
                    <option value="volleyball" <?php echo ($sports_category === 'volleyball') ? 'selected' : ''; ?>>Volleyball</option>
                    <option value="football" <?php echo ($sports_category === 'football') ? 'selected' : ''; ?>>Football</option>
                    <option value="basketball" <?php echo ($sports_category === 'basketball') ? 'selected' : ''; ?>>Basketball</option>
                    <option value="badminton" <?php echo ($sports_category === 'badminton') ? 'selected' : ''; ?>>Badminton</option>
                    <option value="table-tennis" <?php echo ($sports_category === 'table-tennis') ? 'selected' : ''; ?>>Table Tennis</option>
                </select>
            </div><br>
            <button type="submit" id="btn1" class="btn">Submit</button>
        </form>
            </div>
            
            </div>
        </div>
    </div>
</div>


    <script>
        // Function to set the current date and time to the "Date" and "Time" input fields
        function setCurrentDateTime() {
            const currentDate = new Date();
            const dateInput = document.getElementById('date');
            const timeInput = document.getElementById('time');
            const dateString = currentDate.toISOString().substr(0, 10); // Format: YYYY-MM-DD
            const timeString = currentDate.toTimeString().substr(0, 5); // Format: HH:mm
            dateInput.value = dateString;
            timeInput.value = timeString;
        }

        // Function to hide the success message after 1 second
        function hideSuccessMessage() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 1000); // 1 second (1000 milliseconds)
            }
        }

        // Call the function to set the current date and time when the page loads
        setCurrentDateTime();

        // Call the function to hide the success message after 1 second
        hideSuccessMessage();
    </script>
</body>
</html>
