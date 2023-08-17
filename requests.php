<?php
session_start();

// Include the database connection file
require_once 'database.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION["user"];
$success_message = "";

//mycode
$department_sql = "SELECT department FROM users WHERE name = ?";
$department_stmt = $conn->prepare($department_sql);
$department_stmt->bind_param("s", $user_name);
$department_stmt->execute();
$department_result = $department_stmt->get_result();
$department_data = $department_result->fetch_assoc();

$user_department = $department_data["department"];

//my code end=====

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $subject = $_POST["subject"];
    $description = $_POST["description"];
    //$department = $_POST["department"];
    // Get the current date and time in server's timezone
    $currentDateTimeServer = new DateTime('now', new DateTimeZone('UTC'));
    $currentDateTimeServer->setTimezone(new DateTimeZone('Asia/Kolkata'));

    // Separate date and time components
    $currentDate = $currentDateTimeServer->format('Y-m-d');
    $currentTime = $currentDateTimeServer->format('H:i:s');

    // Validate and sanitize data (you can add more validation as needed)
    if (empty($subject) || empty($description)) {
        $success_message = "All fields are required.";
    } else {
        // Perform database insertion here
        // Using prepared statements for security
        $sql = "INSERT INTO requests (from_field, department, subject, description, date_created, time_created) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $user_name, $user_department, $subject, $description, $currentDate, $currentTime);

    
       
        if ($stmt->execute()) {
            $success_message = "Request letter created successfully!";
        } 
         $department_stmt->close();
         $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Request Letter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .compose-form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .alert-message {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 9999;
            width: 300px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            display: none;
        }
       
    </style>
</head>
<body  style="background-image:linear-gradient(to bottom,#44156a,#44156a,blueviolet,blueviolet,#44156a);">
     <!-- navbar -->
  <nav class="navbar navbar-expand-lg " style="padding-top: 20px; padding-bottom: 20px; margin-bottom:30px; background-color:#fff">
  <div class="container-fluid">
    <a class="navbar-brand"><span style="margin-left: 50px; font-size:xx-large; color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif "><strong>Request</strong></span></a>
    <form class="d-flex" role="search">
      <a class="btn btn-secondary" href="index.php" style="margin-right: 100px; background-image:linear-gradient(to right,#44156a,blueviolet); color:#fff;" ><span style="color:white;"><i class="fa fa-arrow-left"></i>  back</span></a>
      

    </form>
  </div>
</nav>
<!-- /navbar -->
<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-8" >
            
            <div class="compose-form">
                <div class="form-header border"style="border:2px solid #ffffff;   background-image:linear-gradient(to right,#44156a,#44156a,blueviolet,white); color:#ffffff; margin-bottom:10px " ><h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;margin-top:5px">&nbsp;<span class="material-symbols-outlined">
mail
</span>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a class="btn" href="my_request.php" style="margin-left:80px; background-color:none; color:#44156a; " ><b>My Requests</b></a>
</h2> </div>
<?php if (!empty($success_message)): ?>
                <div id="successMessage" class="alert alert-success mt-4"><?php echo $success_message ?></div>
            <?php endif; ?>
                
                <!-- Add the "action" attribute to submit the form data to "requests.php" -->
                <form action="requests.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="from" name="from" value="<?php echo $user_name; ?>" readonly>
                    </div>
                    <div class="form-group">
        <!-- Add the dropdown for department selection -->
                    <!-- <label for="department">Select Department:</label> -->
                    <!-- <select class="form-control" id="department" name="department" required>
                    <option value="MCA">MCA</option>
                    <option value="MBA">MBA</option>
                    <option value="BIO">BIO</option>
                    </select> -->
                    <input type="text" class="form-control" id="from" name="from" value="<?php echo $user_department; ?>" readonly>

                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="description" name="description" rows="8" placeholder="Description" required></textarea>
                    </div><br>
                    <button type="submit" class="btn" style="background-color: blueviolet; color:white;">Send Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
   function hideSuccessMessage() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 1000); // 2 seconds (2000 milliseconds)
            }
        }
        hideSuccessMessage();
</script>

</body>
</html>

