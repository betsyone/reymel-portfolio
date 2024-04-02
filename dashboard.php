<?php
session_start();
include 'db_config.php';

if(isset($_SESSION["username"])) {
    // Assuming your user table has a column named "first_name"
    $username = $_SESSION["username"];
    // Fetch the user's first name from the database
    $sql = "SELECT firstname FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $firstName = $row["firstname"];
    } else {
        // Handle the case where the user's first name is not found
        $firstName = "Unknown";
    }
} else {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Company - Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>

.sidenav {
    height: 100%;
    width: 180px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fffefe;
    padding-top: 70px;
    color: #000000;
    border-right: 1px solid #000000;
}

.sidenav a {
    padding: 10px 8px 10px 16px;
    text-decoration: none;
    font-size: 18px;
    color: #000000;
    display: block;
}

.sidenav a:hover {
    color: #000000;
}


.content {
    padding-left: 180px; 
    padding-right: 200px;
    padding-top: 80px; 
    padding-bottom: 70px; 
    position: relative; 
}


.navbar {
    z-index: 1010;
    position: fixed; 
    width: 100%; 
    top: 0;
}

.navbar-brand {
    text-align: left;
}

.navbar-brand img {
    margin-left: 10px; 
    vertical-align: middle; 
}


footer {
    position: relative;
    bottom: 0;
    left: 0; 
    width: 100%;
    z-index: 100; 
}

.fa-chevron-down {
        color: black; 
        margin-left: 5px; 
    }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <span style="display: inline-block; vertical-align: middle;">LexiFlow Solution Inc</span>
        <img src="logo.png" alt="Company Logo" height="40">
    </a>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <span class="nav-link d-inline mr-2 d-lg-inline d-lg-none" data-toggle="tooltip" title="Username">
                Hey, <?php echo $firstName; ?>
            </span>
            </li>
            <li class="nav-item">
                <a class="nav-link d-inline mr-2" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>




<div class="sidenav">
    <a href="#">Dashboard</a>
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" id="profileDropdownToggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Profile
            <i class="fa fa-chevron-down" style="color: black;"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdownToggle">
            <a class="dropdown-item" href="view_profile.php">View Profile</a>
            <a class="dropdown-item" href="update_profile.php">Update Profile</a>
        </div>
    </div>
    <a href="lexibot.php">LexiBot</a>
</div>






<div class="content">
  
    <div class="container">
        <h1>What is LexiFlow Solutions Inc.</h1>
        <p>At LexiFlow Solutions Inc., we specialize in revolutionizing the way people communicate.</p>
        <p>Our innovative technologies harness the power of natural language processing and artificial intelligence to create seamless and dynamic conversational experiences.</p>
        <p>With a focus on precision, adaptability, and user-centric design, we're shaping the future of conversational technology one interaction at a time.</p>
    </div>

    <div class="container" id="about-us">
        <h2>About Us</h2>
        <p>LexiFlow Solutions Inc. is a leading provider of conversational AI solutions.</p>
        <p>Founded in 2024, our company has been at the forefront of innovation in natural language processing and artificial intelligence.</p>
        <p>We are committed to helping businesses enhance customer engagement, streamline operations, and drive growth through our cutting-edge technologies.</p>
    </div>


    <div class="container" id="services">
        <h2>Our Services</h2>
        <ul>
            <li>Customer Support </li>
            <li>Virtual Assistant </li>
            <li>Language Understanding </li>
        </ul>
    </div>

    <div class="container" id="meet-my-team">
        <h2>Meet My Team</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reymel Mislang</h5>
                        <p class="card-text">Position: CEO</p>
                        <p class="card-text">Email: reymelrey.mislang@lexiflow.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kyluee B.</h5>
                        <p class="card-text">Position: CTO</p>
                        <p class="card-text">Email: kyluee@lexiflow.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Emanuel Calica</h5>
                        <p class="card-text">Position: Janitor</p>
                        <p class="card-text">Email: calica.emaan@lexiflow.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" id="contact">
        <h2>Contact Us</h2>
        <p>For inquiries or partnerships, feel free to contact us:</p>
        <p>Email: info@lexiflow.com</p>
        <p>Phone: 8-7000-2224</p>
    </div>
</div>

<footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Follow Us</h2>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" class="text-light">Facebook</a></li>
                    <li class="list-inline-item"><a href="#" class="text-light">Twitter</a></li>
                    <li class="list-inline-item"><a href="#" class="text-light">Instagram</a></li>
                    <li class="list-inline-item"><a href="#" class="text-light">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <hr class="bg-light">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="mb-0">&copy; 2024 LexiFlow Solution Inc. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>>
</body>
</html>
