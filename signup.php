<?php


// Include the database connection file
require_once 'database.php';

?>


 
<!DOCTYPE html>
<html>
<head>
    <title>Sports Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <style>
        #grad1{
          background-image:linear-gradient(to bottom,#44156a,blueviolet,blueviolet,blueviolet,#44156a);
        }
        #grad{
            /* background-image:linear-gradient(to bottom right,#44156a,#44156a,white); */
            background-image:linear-gradient(to right ,#44156a,blueviolet,white);
    
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
  animation-duration: 3s;
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
<div class="container" style="margin-top: 80px;">
    <?php
    // print_r($_POST);
    if(isset($_POST["submit"]))
    {
      $username = $_POST["uname"];
      $department = $_POST["department"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $repeatpassword = $_POST["repeat_password"];

      $passwordHash = password_hash($password, PASSWORD_DEFAULT); // hashing

      $errors = array();

      if(empty($username) || empty($email) || empty($password) || empty($repeatpassword)) {
        array_push($errors, "All fields are required");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
      }

      if (strlen($password) < 3) {
        array_push($errors, "Password must be at least 3 characters long");
      }

      if ($password !== $repeatpassword) {
        array_push($errors, "Passwords do not match");
      }

      require_once "database.php";
      $sql = "INSERT INTO users (name, department, email, password) VALUES (?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $username, $department, $email, $passwordHash);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
          $_SESSION["user"] = $username; // Save the username in the session
                header("Location: login.php");
                exit();
          
        } else {
          
          $errors[] = "Failed to register. Please try again later.";
        }

        mysqli_stmt_close($stmt);
      } else {
        
        $errors[] = "Something went wrong.";
      }

      mysqli_close($conn);
    }
    ?>
    <div class="container"  >
    <div class="card mb-2" >
    <div class="card-header text-white" id="grad" >
            <h4 id="fsz">SIGNUP</h4>
          </div>
          <?php if (!empty($errors)): ?>
    <div class="alert alert-danger mt-12 text-center">
        <?php foreach ($errors as $error): ?>
            <p><b><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></b></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
  <div class="row g-0" ><br>
    <div class="col-md-4"  >
      <img src="img\abstract-batsman-playing-cricket-from-splash-watercolors-illustration-paints_291138-405 (1).avif" class="img-fluid"  alt="...">
    </div>
    <div class="col-md-7" style="padding:15px; padding-right:-10px">
      <div class="card-body">
      <form action="signup.php" method="POST">
              <div class="form-group">
                <label class="label" for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter your username" name="uname" required >
              </div>
              <?php
            // Set default value for $department
            $department = '';
            ?>
              <div class="form-group">
                <label class="label" for="department">Department</label>
                <select class="form-control" name="department" id="department" required >
                    <option value="">Select Department</option>
                    <option value="MCA" <?php echo ($department === 'MCA') ? 'selected' : ''; ?>>MCA</option>
                    <option value="MBA" <?php echo ($department === 'MBA') ? 'selected' : ''; ?>>MBA</option>
                    <option value="BIO" <?php echo ($department === 'BIO') ? 'selected' : ''; ?>>BIO</option>
                </select>
            </div>
              <div class="form-group">
                <label class="label" for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
              </div>
              <div class="form-group">
                <label class="label" for="password">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required >
                </div>
              </div>
              <div class="form-group">
                <label class="label" for="repeat_password">Repeat Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="repeat_password" placeholder="Repeat your password" name="repeat_password" required >
                </div>
              </div><br>
              <button type="submit" class="btn " id="signup-button" name="submit" value="Register" >&nbsp;Signup&nbsp;</button>
            </form>
            <br>
            <p>If registered ? <a id=lnk href="login.php">login Here</a></p>
      </div>
    </div>
  </div>
</div>
</div>
    
</body>
</html>

