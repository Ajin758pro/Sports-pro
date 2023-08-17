<?php
session_start();

// Check if the admin session variable exists and is set to "admin"
if (!isset($_SESSION["user"]) || $_SESSION["user"] !== "admin") {
    // If the admin session is not set or not equal to "admin", redirect to the login page
    header("Location:login.php");
    exit();
}

// The user is logged in as an admin, continue with the admin dashboard page
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Open Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
      body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: rgb(247, 246, 252);
    color: rgb(70, 71, 81);
    font-family: 'Open Sans', sans-serif;
  }
  
  .material-icons-outlined {
    vertical-align: middle;
    line-height: 1px;
    font-size: 30px;
  }
  
  .text-secondary {
    color: rgb(70, 71, 81);
  }
  
  .text-blue {
    color: rgb(29, 38, 154);
  }
  
  .background-blue {
    background-color: rgb(29, 38, 154);
  }
  
  .text-red {
    color: rgb(213, 0, 0);
  }
  
  .background-red {
    background-color: rgb(213, 0, 0);
  }
  
  .text-green {
    color: rgb(46, 125, 50);
  }
  
  .background-green {
    background-color: rgb(46, 125, 50);
  }
  
  .text-orange {
    color: rgb(255, 111, 0);
  }
  
  .background-orange {
    background-color: rgb(255, 111, 0);
  }
  
  .grid-container {
    display: grid;
    grid-template-columns: 260px 1fr 1fr 1fr;
    grid-template-rows: 0.2fr 3fr;
    grid-template-areas:
      'sidebar header header header'
      'sidebar main main main';
    height: 100vh;
  }
  
  /* ---------- HEADER ---------- */
  
  .header {
    grid-area: header;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px 0 30px;
    box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
  }
  
  .menu-icon {
    display: none;
  }
  
  /* ---------- SIDEBAR ---------- */
  
  #sidebar {
    grid-area: sidebar;
    height: 100%;
    background-color:#44156a;
    color: rgb(255, 255, 255);
    overflow-y: auto;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
  }
  
  .sidebar-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 20px 20px 20px;
    margin-bottom: 30px;
  }
  
  .sidebar-title > span {
    display: none;
  }
  
  .sidebar-brand {
    margin-top: 15px;
    font-size: 30px;
    font-weight: 700;
  }
  
  .sidebar-brand > .material-icons-outlined {
    font-size: 50px;
  }
  
  .sidebar-list {
    padding: 0;
    margin-top: 15px;
    list-style-type: none;
  }
  
  .sidebar-list-item {
    padding: 20px 20px 20px 20px;
    font-size: 18px;
  }
  
  .sidebar-list-item:hover {
    background-color: rgba(255, 255, 255, 0.2);
    cursor: pointer;
  }
  
  .sidebar-list-item > a {
    text-decoration: none;
    color: rgb(180, 184, 244);
  }
  
  .sidebar-responsive {
    display: inline !important;
    position: absolute;
  }
  
  /* ---------- MAIN ---------- */
  
  .main-container {
    grid-area: main;
    overflow-y: auto;
    padding: 20px 20px;
  }
  
  .main-title {
    display: flex;
    justify-content: space-between;
  }
  
  .main-cards {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 20px;
    margin: 20px 0;
  }
  
  .card {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    padding: 25px;
    color: rgb(255, 255, 255);
    border-radius: 30px;
    box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
  }
  
  .card:first-child {
    background-color:mediumvioletred;
  }
  
  .card:nth-child(2) {
    background-color:darkmagenta;
  }
  
  .card:nth-child(3) {
    background-color:darkslateblue;
  }
  
  .card:nth-child(4) {
    background-color:#44156a;
  }
  
  .card-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .card-inner > span {
    font-size: 50px;
  }
  
  .products {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  
  .product-card {
    height: 350px;
    background-color: rgb(255, 255, 255);
    padding: 25px;
    border-radius: 30px;
    box-shadow: 0 6px 7px -4px rgba(0, 0, 0, 0.2);
  }
  
  .product-description {
    padding-top: 50px;
  }
  
  .product-button {
    background-color:#44156a;
    color: rgb(255, 255, 255);
    padding: 20px;
    border-radius: 30px;
  }
  
  .product-button > .material-icons-outlined {
    font-size: 50px;
  }
  
  .social-media {
    height: 350px;
    padding: 10px;
  }
  
  .product {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  
  .product-icon {
    color: rgb(255, 255, 255);
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
  }
  
  .product-icon > .bi {
    font-size: 25px;
  }
  
  /* ---------- MEDIA QUERIES ---------- */
  
  /* Medium <= 992px */
  @media screen and (max-width: 992px) {
    .grid-container {
      grid-template-columns: 1fr;
      grid-template-rows: 0.2fr 3fr;
      grid-template-areas:
        'header'
        'main';
    }
  
    #sidebar {
      display: none;
    }
  
    .menu-icon {
      display: inline;
    }
  
    .sidebar-title > span {
      display: inline;
    }
  }
  
  /* Small <= 768px */
  @media screen and (max-width: 768px) {
    .main-cards {
      grid-template-columns: 1fr;
      gap: 10px;
      margin-bottom: 0;
    }
  
    .products {
      grid-template-columns: 1fr;
      margin-top: 30px;
    }
  }
  
  /* Extra Small <= 576px */
  @media screen and (max-width: 576px) {
    .header-left {
      display: none;
    }
  }
 #btn1{
  background-color: blueviolet;
  color: white;
 }



    </style>
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <!-- <span class="material-icons-outlined">search</span> -->
          <H1 style="color:#44156a; font-family:Verdana, Geneva, Tahoma, sans-serif"><b>Sports Tracker</b></H1>
        </div>
        <div class="header-right">
        
          <a class="btn btn-danger" href="logout.php" ><span style="color:white;"><i class="fas fa-sign-out-alt"> </i>Logout</span></a>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <p>Dashboard</p>
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a href="index.php">
              <span class="material-icons-outlined">home</span> Home
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="admin_view_logs.php">
              <span class="material-icons-outlined" >app_registration</span> Log Register
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="admin_view_equipments.php">
              <span class="material-icons-outlined">sort</span> Equipments
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="admin_fixtures.php">
              <span class="material-icons-outlined">event</span>Fixtures
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="admin_view_requests.php">
              <span class="material-icons-outlined">mail</span> Requests
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="admin_view_team_members.php">
              <span class="material-icons-outlined">groups</span> Teams
            </a>
          </li>
          
          <li class="sidebar-list-item">
            <a href="admin_notification.php">
            <span class="material-icons-outlined">notifications</span> Notifications
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="users.php">
              <span class="material-icons-outlined">group</span> Users
            </a>
          </li>
        
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
        </div>

        <div class="main-cards">

         
           <div class="card text-center">
  <div class="card-header">
    <strong>CREATE</strong>
  </div>
  <div class="card-body">
    <h1 class="card-title"><span class="material-icons-outlined">notifications</span></h1>
    <h4 class="card-text"><b>NOTIFICATIONS</b></h4> <br>
  </div>
  <div class="card-footer text-body-secondary">
        <a id="btn1" href="create_notification.php" class="btn ">Click Here</a>
  </div>
</div>
         
          <div class="card text-center">
  <div class="card-header">
    <strong>CREATE</strong>
  </div>
  <div class="card-body">
    <h1 class="card-title"><span class="material-icons-outlined">
event_note
</span></h1>
    <h4 class="card-text"><b>FIXTURES</b></h4> <br>
  </div>
  <div class="card-footer text-body-secondary">
        <a id="btn1" href="create_fixtures.php" class="btn ">Click Here</a>
  </div>
</div>

          
          <div class="card text-center">
  <div class="card-header">
    <strong>ADD</strong>
  </div>
  <div class="card-body">
    <h1 class="card-title"><span class="material-icons-outlined">groups</span></h1>
    <h4 class="card-text"><b>TEAM MEMBER</b></h4> <br>
  </div>
  <div class="card-footer text-body-secondary">
        <a id="btn1" href="insert_team_member.php" class="btn">Click Here</a>
  </div>
</div>

         
          <div class="card text-center">
  <div class="card-header">
    <strong>ADD</strong>
  </div>
  <div class="card-body">
    <h1 class="card-title"><span class="material-icons-outlined">notifications</span></h1>
    <h4 class="card-text"><b>EQUIPMENTS</b></h4> <br>
  </div>
  <div class="card-footer text-body-secondary">
        <a id="btn1" href="add_equipment.php" class="btn ">Click Here</a>
  </div>
</div>

        </div>

        <div class="products">

          <div class="product-card">
            <h2 class="product-description">Latest Updates</h2>
            <p class="text-secondary">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce laoreet facilisis nulla, consectetur pulvinar diam. Aliquam tempus vel quam.
            </p>
            <button type="button" class="product-button">
              <span class="material-icons-outlined">add</span>
            </button>
          </div>

          <div class="social-media">
            <div class="product">

              <div>
                <div class="product-icon" style="background-color: mediumvioletred;">
                  <i class="bi bi-twitter"></i>
                </div>
                <h1 class="text" style="color:mediumvioletred">+274</h1>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
  
              <div>
                <div class="product-icon " style="background-color: darkmagenta;">
                  <i class="bi bi-instagram"></i>
                </div>
                <h1 class="text"style="color:darkmagenta;">+352</h1>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
  
              <div>
                <div class="product-icon " style="background-color: darkslateblue;">
                  <i class="bi bi-facebook"></i>
                </div>
                <h1 class="text" style="color:darkslateblue;">-126</h1>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
  
              <div>
                <div class="product-icon" style="background-color: #44156a;">
                  <i class="bi bi-linkedin"></i>
                </div>
                <h1 class="text" style="color:#44156a;">+102</h1>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
              
            </div>
          </div>

        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script >

// SIDEBAR TOGGLE

var sidebarOpen = false;
var sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}
    </script>
  </body>
</html>