<?php
session_start();
include 'db_config.php';

$usernameExists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];

    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        $usernameExists = true;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password, lastname, firstname, middlename, birthdate, gender) 
                  VALUES ('$username', '$hashed_password', '$lastname', '$firstname', '$middlename', '$birthdate', '$gender')";

        if ($conn->query($query) === TRUE) {
            echo "<script>alert('Registration successful! Please login.'); window.location.href = 'login.php';</script>";
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registration Form</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <style>

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

  
    .card {
      margin-top: -20px;
    }

    .card-header {
      text-align: left;
    }

    .card-body {
      padding: 5px; 
    }

    
    .form-control {
      width: 100%; 
    }

    .btn-primary {
      display: block;
      margin: 0 auto;
    }

  
    .container {
      width: 100%;
      padding-right: 30px;
      padding-left: 20px;
      margin-right: auto;
      margin-left: auto;
      max-width: 6000px; 
    }

    .sidebar {
      background-color: #f8f9fa; 
      padding: 20px;
      height: 100vh;
    }


    .photo-container {
      position: relative;
    }


    .photo {
      max-width: 100%; 
      height: auto;
    }


    .bottom-text {
      position: absolute;
      bottom: 10px; 
      left: 50%;
      transform: translateX(-50%);
      color: white;
      font-size: 18px;
    }

    @media (max-width: 576px) {
            .navbar-brand {
                padding-right: 0;
            }
            .navbar-toggler {
                margin-left: auto;
            }
            .navbar-nav {
                flex-direction: column;
                margin-right: auto;
            }
            .navbar-nav .nav-item {
                margin-bottom: 5px;
            }
        }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        
        <a class="navbar-brand mr-auto" href="#">
            <img src="logo.png" alt="Company Logo" style="max-height: 40px;">
            LexiFlow Solution Inc.
        </a>
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
  <div class="row justify-content-center mt-5">

  <div class="col-md-4 sidebar">
    <div class="photo-container position-relative">
        <img src="chatbot.jpg" alt="Side Photo" class="photo" >
        <div class="welcome-message">
            <p>About Our Company:</p>
            <p>LexiFlow Solution Inc. is a leading provider of innovative solutions in IT industry . We specialize in conversiontal AI. Our mission is to focus on precision, adaptability, and user-centric design, we're shaping the future of conversational technology one interaction at a time.</p>
          </div>
    </div>
</div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Registration Form</h5>
          <p class="mb-0">Please fill out the following information to register:</p>
        </div>
        <div class="card-body">

            <form action="register.php" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                  </div>
                  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" required onkeyup="checkPasswordStrength(this.value)">
    <small id="passwordStrength" class="form-text text-muted">Password strength: <span id="passwordStrengthText"></span></small>
</div>

                  <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="middlename">Middle Name</label>
                    <input type="text" id="middlename" name="middlename" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>

          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="usernameExistsModal" tabindex="-1" role="dialog" aria-labelledby="usernameExistsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usernameExistsModalLabel">Username Already Exists</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        The username you entered already exists. Please choose a different one.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
  <?php if ($usernameExists): ?>
    $(document).ready(function(){
      $('#usernameExistsModal').modal('show');
    });
  <?php endif; ?>
</script>
<script>
    function checkPasswordStrength(password) {
        var passwordStrengthText = document.getElementById("passwordStrengthText");
        var passwordStrength = document.getElementById("passwordStrength");

        // Define the criteria for password strength
        var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        var mediumRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");

        if (strongRegex.test(password)) {
            passwordStrengthText.innerHTML = "Strong";
            passwordStrength.classList.remove("text-muted");
            passwordStrength.classList.add("text-success");
        } else if (mediumRegex.test(password)) {
            passwordStrengthText.innerHTML = "Medium";
            passwordStrength.classList.remove("text-muted");
            passwordStrength.classList.add("text-warning");
        } else {
            passwordStrengthText.innerHTML = "Weak";
            passwordStrength.classList.remove("text-success");
            passwordStrength.classList.remove("text-warning");
            passwordStrength.classList.add("text-muted");
        }
    }
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
