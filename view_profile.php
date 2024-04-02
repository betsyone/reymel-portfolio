<?php
session_start();
include 'db_config.php';

// Check if the user is logged in
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit;
}

// Fetch user information from the database
$query = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($query);

// Check if user exists and fetch the data
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $middlename = $row['middlename'];
    $birthdate = $row['birthdate'];
    $gender = $row['gender'];
} else {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: whitesmoke;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        /* Custom CSS styling */
        .container {
            max-width: 1200px; /* Increase container width for sidebar */
            margin: auto;
        }
        .back-btn {
            margin-bottom: 20px;
        }
        /* Sidebar styling */
        .sidebar {
            background-color: #f8f9fa; /* Light gray background color */
            border-radius: 5px;
            padding: 20px;
        }
        .sidebar img {
            max-width: 100%; /* Ensure the image fits within the sidebar */
            border-radius: 5px; /* Add border radius for aesthetics */
            margin-bottom: 15px; /* Add some space below the image */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Profile</h2>
        <br>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">First Name:</th>
                            <td><?php echo $firstname; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Last Name:</th>
                            <td><?php echo $lastname; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Middle Name:</th>
                            <td><?php echo $middlename; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Birthdate:</th>
                            <td><?php echo $birthdate; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Gender:</th>
                            <td><?php echo $gender; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <!-- Sidebar -->
                <div class="sidebar">
                    <img src="sidebar.jpg" alt="Sidebar Photo"> <!-- Replace 'sidebar_photo.jpg' with the path to your photo -->
                    <p>Get 20% off on all products! Use code <strong>SAVE20</strong> at checkout.</p>
                    <a href="https://example.com" target="_blank" class="btn btn-primary">Shop Now</a> <!-- Replace 'https://example.com' with the URL of your shop -->
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <br>
                <br>
                <br>
                <br>
                <a href="dashboard.php" class="btn btn-secondary back-btn w-100">Back to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
