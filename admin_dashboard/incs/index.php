<?php 
require_once('conn.php');
session_start();
$admin_username = $_SESSION['admin_username'];
$admin_password = $_SESSION['admin_password'];
$admin_role = $_SESSION['role'];

if ($admin_username && $admin_password == true) {
    // Continue
} else {
    header('location:admin_login.php');
    exit(); // Always call exit() after a header redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="../css/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .sidebar {
        background-color: #343a40;
        min-height: 100vh;
        padding-top: 30px;
        width: 300px;
    }

    .sidebar .sidebar-heading {
        color: white;
        text-align: center;
        font-size: 24px;
    }

    .sidebar img {
        width: 100px;
        border-radius: 50%;
        display: block;
        margin: 0 auto;
    }

    .sidebar ul {
        list-style-type: none;
        padding-left: 0;
    }

    .sidebar ul li {
        padding: 10px 0;
        text-align: center;
    }

    .sidebar ul li a {
        color: white;
        text-decoration: none;
        font-size: 18px;
    }

    .sidebar ul li a:hover {
        background-color: #575757;
        border-radius: 5px;
    }

    .content {
        padding: 20px;
    }

    .card-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .card-col {
        flex: 1;
        padding: 0 10px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        background-color: #fff;
    }

    .card-header {
        background-color: #343a40;
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 20px;
        font-size: 16px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        width: 200px;
        height: 50px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .card ul {
        list-style-type: none;
        padding-left: 0;
    }

    .card ul li {
        margin-bottom: 10px;
        font-size: 16px;
    }

    .card ul li:hover {
        text-decoration: underline;
        cursor: pointer;
    }

    .card_items {
        height: 200px;
    }

    .dropbtn {
        color: white;
        padding: 16px;
        font-size: 18px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .dropdown {
        position: relative;
        display: inline-block;
        margin-left: 60px;
    }

    .dropdown-content {
        display: none;
        min-width: 160px;
        z-index: 1;
        border-radius: 4px;
    }

    .dropdown-content a {
        color: white;
        padding: 2px auto;
        text-decoration: none;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-12 sidebar">
                        <div class="sidebar-heading">
                            <img src="../images/zahidiqbal.jpeg" alt="Admin Picture">
                            <h3><?php echo $admin_role; ?> Dashboard</h3>
                            <h5>Zahid Iqbal</h5>
                            <hr>
                        </div>
                        <ul>
                            <?php if($admin_role == 'Superadmin'):?>
                            <li><a href="#" onclick="dashboard()">Dashboard</a></li>

                            <div class="dropdown">
                                <li class="dropbtn">Create categories</li>
                                <div class="dropdown-content">
                                    <li><a href="#" onclick="admin1()">Add Admin</a></li>
                                    <li><a href="#" onclick="subadmin()">Add sub admin</a></li>
                                    <li><a href="#" onclick="user()">Add user</a></li>
                                    <hr style="color:white">
                                </div>
                            </div>

                            <li><a href="#" onclick="slider_list()">Slider list</a></li>
                            <li><a href="#" onclick="news_list()">News list</a></li>
                            <li><a href="#" onclick="marquee_list()">Marquee list</a></li>
                            <?php endif; ?>
                        </ul>
                        <ul>
                            <?php if($admin_role == 'Admin' || $admin_role == 'Subadmin'): ?>
                            <li><a href="#" onclick="dashboard()">Dashboard</a></li>
                            <li><a href="#" onclick="country_list()">Country List</a></li>
                            <li><a href="#" onclick="state_list()">State List</a></li>
                            <li><a href="#" onclick="city_list()">City List</a></li>
                            <?php endif; ?>
                        </ul>
                        <ul>
                            <?php if($admin_role == 'User'): ?>
                            <li><a href="#" onclick="usersliderlist()">Slider List</a></li>
                            <li><a href="#" onclick="usernewslist()">News List</a></li>
                            <li><a href="#" onclick="usermarqueelist()">Marquee List</a></li>
                            <?php endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
         
            
                
                <div class="col-md-10">
                    <div class="row">
                        <div class="row">
                        
                            <div class="col-md-10">
                            <h1 class="fw-bold"><?php echo $admin_role; ?> Dashboard</h1>
                               <
                            </div>
                            <div class="col-md-2">
                                <form action="logout.php" method="post">
                                    <button type="submit" name="logout" class="btn btn-danger" style="margin-left:160px; border-radius:5px;">Logout</button>
                                </form>
                            </div>
                        </div>
                        <hr style="color:black;">
                    <?php
                    if ($admin_role === 'Superadmin' || $admin_role === 'Admin' || $admin_role === 'Subadmin') {
                        echo '

                        <div class="card mt-4" id="main_content">
                            <div class="card-header">
                                <h5 class="card-title">Student Management System</h5>
                            </div>
                            <div class="card-body">
                                <div class="row card-items">
                                    <div class="col-md-4">
                                        <div class="card slider_card">
                                           
                                            <div class="card-body">
                                                <button class="btn btn-secondary" onclick="country()">Add Country</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card news_card">
                                            
                                            <div class="card-body">
                                                <button class="btn btn-secondary" onclick="state()">Add State</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card marquee_card">
                                            
                                            <div class="card-body">
                                                <button class="btn btn-secondary" onclick="city()">Add City</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                          
                             </div>
                        </div>
                    </div>';
            }
            ?>
      
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/country.js"></script>
   

            <?php 
          require_once('country_html.php');
             require_once('country_list.php');
            require_once('state_list.php');
            require_once('city_list.php');
               require_once('u_country_list.php');
            require_once('u_city_list.php');
            require_once('u_state_list.php');
         
            require_once('state.php');
            require_once('city.php');
            
            require_once('admin_form.php');
           
            require_once('sub_admin_form.php');
            require_once('state_edit.php');
            require_once('user_form.php');
            ?>

        </div>
         
    </div>
    
    </div>

    <?php 

?>
    
    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    

</body>

</html>