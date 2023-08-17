<?php
// Include the database connection file
require_once 'database.php';

// Initialize the errors array
$errors = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the notification description from the form
    $description = $_POST["description"];

    // Validate the notification description
    if (empty($description)) {
        $errors[] = "Description is required";
    }

    // If there are no errors, proceed to save the notification
     if (empty($errors)) {
         try {
            // Save the notification to the database
            $stmt = $conn->prepare("INSERT INTO notifications1 (description, date, time) VALUES (?, ?, ?)");

            // Get the current date and time
            $current_date = date("Y-m-d");
            $current_time = date("H:i:s");
            // Get the current date and time in server's timezone

            $stmt->bind_param("sss", $description, $current_date, $current_time);
            $stmt->execute();

            // Check if the notification was successfully inserted
            if ($stmt->affected_rows > 0) {
                $success_message = "Notification created successfully!";
            } else {
                $errors[] = "Failed to create notification. Please try again later.";
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
                <strong>Create Notifications</strong>
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

<br><br>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6" style="background-color: #ffffff; border: 2px solid #dddddd; padding: 20px; border-radius: 10px;">
            
            <div class="compose-form">
                <div class="form-header border"style="border:2px solid #ffffff; background-color:#44156a; color:#ffffff; margin-bottom:10px " ><h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;margin-top:5px">&nbsp;<span class="material-symbols-outlined">
                notifications_active</span></h2></div>
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger mt-4">
                    <?php foreach ($errors as $error): ?>
                        < <p><?php echo $error; ?></p> -->
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success mt-4"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <form method="post" class="mt-4">
                <div class="form-group">
                    <label for="description">Description:</label>
                    <!-- Adjust the padding and margin for the textarea element -->
                    <textarea class="form-control" name="description" id="description" rows="4" style="width: 100%; margin-bottom: 10px;"></textarea>
                </div>

                <!-- Date and Time input fields -->
                <!-- Hidden input fields to capture the current date and time -->
                <input type="hidden" name="date" id="date">
                <input type="hidden" name="time" id="time">
                <!-- <input type="date" name="date" id="date">
                <input type="time" name="time" id="time"> -->

                <br>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create</button>
                <a href="admin_notification.php" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View notifications</a>
            </form>
        </div>
    </div>
</div>




<script>
    
function setCurrentDateTime() {
    const currentDate = new Date();
    
    // Adjust for Indian time zone offset (UTC+5:30)
    const indianTimeOffset = 5.5 * 60 * 60 * 1000; // Offset in milliseconds
    const indianTime = new Date(currentDate.getTime() + indianTimeOffset);
    
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');
    
    // Format the date and time
    const dateString = indianTime.toISOString().substr(0, 10); // Format: YYYY-MM-DD
    const timeString = indianTime.toISOString().substr(11, 5); // Format: HH:mm
    
    dateInput.value = dateString;
    timeInput.value = timeString;
}

// Call the function to set the current Indian date and time
setCurrentDateTime();
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

</body>
</html>
