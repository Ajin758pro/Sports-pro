<?php
session_start();

// Include the database connection file
require_once 'database.php';

if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email and password are correct
    if ($email === "admin@gmail.com" && $password === "1212") {
        $_SESSION["user"] = "admin"; // Set a special session value to indicate admin login
        header("Location: dashboard.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $hashedPassword = $user["password"];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user"] = $user["name"]; // Save the username in the session
            header("Location: index.php");
            exit();
        } else {
            // echo "<div class='alert alert-danger'>Invalid email or password.1</div>";
         $errors[] = "Invalid email or password";
  
        
         }
    } else {
        // echo "<div class='alert alert-danger'>Invalid email or password.2</div>";
        $errors[] = "Invalid email or password.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Sports Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <style>
        #grad1{
          background-image:linear-gradient(to bottom,#44156a,blueviolet,blueviolet,blueviolet,#44156a);
        }
        #grad{
            /* background-image:linear-gradient(to bottom right,#44156a,#44156a,white); */
            background-image:linear-gradient(to right ,#44156a,blueviolet,blueviolet,white);
        
        }
        #shw{
            box-shadow: 10px 10px 5px 2px black;
            
        }
        #fsz{
            font-size: xx-large;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bolder;
            
        }
        .label{
            font-size: large;
            font-weight: bold;
            color: #44156a;
        }
        .btn{
         
          background-color:blueviolet;
          color: white;
        }
        .btn:hover{
          background-color: #44156a;
          color: white;
        }
        #lnk{
              color:blueviolet;
              text-decoration: none;
           }
        .alert{
                
                padding:5px;
                
              }
#fsz{
  
 
  position:relative;
  animation-name: example;
  animation-duration:3s;
}

@keyframes example {
  0%   {color:#44156a; left:0px; top:0px;}
  25%  {color:#44156a; left:200px; top:0px;}
  50%  {color:white; left:0px; top:0px;}
  75%  {color:white; left:0x; top:0px;}
  100% {color:white; left:0x; top:0px;}
}

    </style>

</head>
<body id="grad1">
<div class="container" style="margin-top: 80px;" >


  <?php
    // if (isset($_POST["login"])) {
    //   $email = $_POST["email"];
    //   $password = $_POST["password"];
    //   require_once "database.php";
    //   $sql = "SELECT * FROM users WHERE email = '$email'";
    //   $result = mysqli_query($conn, $sql);
    //   $user = mysqli_fetch_assoc($result);
    //   if ($user) {
    //     $hashedPassword = $user["password"];
    //     if (password_verify($password, $hashedPassword)) {
    //       session_start();
    //       $_SESSION["user"] = "yes";
    //       header("Location: index.php");
    //       exit();
    //     } else {
    //       echo "<div class='alert alert-danger'>Invalid email or password.4</div>";
    //     }
    //   } else {
    //     echo "<div class='alert alert-danger'>Invalid email or password.3</div>";
    //   }
    // }
  ?>
  <div class="card mb-2">
  <div class="card-header text-white" id="grad" >
            <h4 id="fsz">LOGIN</h4>
          </div>
          <?php if (!empty($errors)): ?>
    <div class="alert alert-danger mt-12 text-center">
        <?php foreach ($errors as $error): ?>
            <p><b><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></b></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
  <div class="row g-0">
    <div class="col-md-4">
    <img src="img\abstract-batsman-playing-cricket-from-splash-watercolors-illustration-paints_291138-130.avif" class="img-fluid"  alt="...">
    </div>
    <div class="col-md-7" style="padding:15px; padding-right:-10px">
      <div class="card-body">
      <form action="login.php" method="POST">
        <br><br>
            <div class="form-group">
              <label class="label" for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
            </div>
            <br>
            <div class="form-group">
              <label class="label" for="password">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
              </div>
            </div><br>
            <button type="submit" class="btn " id="login-button" name="login" value="Login">&nbsp;Login&nbsp;</button> 
          </form>
          <br>
          <p>Not registered yet? <a id="lnk" href="signup.php">Signup Here</a></p>
      </div>
    </div>
  </div>
</div>
<script>
        // Function to hide the alert after 2 seconds
        function hideAlert() {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.remove();
                }, 2000); // 2 seconds (2000 milliseconds)
            }
        }

        // Call the hideAlert function when the page is loaded
        document.addEventListener('DOMContentLoaded', hideAlert);
    </script>
</body>
</html>
        

