<?php
session_start();
include 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// Retrieve user's current profile information from the database and pre-fill the form fields
$username = $_SESSION["username"];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Fetch user's profile data
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $middlename = $row["middlename"];
    $birthdate = $row["birthdate"];
    $gender = $row["gender"];
    // You can fetch more profile data as needed
} else {
    // Handle error if user's profile not found
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $middlename = $_POST["middlename"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    // Validate form data (e.g., check for empty fields, validate date format, etc.)

    // Update user's profile information in the database
    $update_sql = "UPDATE users SET firstname=?, lastname=?, middlename=?, birthdate=?, gender=? WHERE username=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssss", $firstname, $lastname, $middlename, $birthdate, $gender, $username);
    if ($update_stmt->execute()) {
        // Profile updated successfully
        echo "<script>alert('Profile updated successfully!');</script>";
        // Redirect user to view their updated profile
        header("Location: view_profile.php");
        exit;
    } else {
        // Handle error if profile update fails
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        h1{
            margin-top: -40px ;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Update Profile</h1>
    <br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="firstname"><b>First Name</b></label>
            <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $firstname; ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname"><b>Last Name</b></label>
            <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $lastname; ?>" required>
        </div>
        <div class="form-group">
            <label for="middlename"><b>Middle Name</b></label>
            <input type="text" id="middlename" name="middlename" class="form-control" value="<?php echo $middlename; ?>">
        </div>
        <div class="form-group">
            <label for="birthdate"><b>Birthdate</b></label>
            <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>" required>
        </div>
        <div class="form-group">
            <label for="gender"><b>Gender</b></label>
            <select id="gender" name="gender" class="form-control" required>
                <option value="male" <?php if($gender == "male") echo "selected"; ?>>Male</option>
                <option value="female" <?php if($gender == "female") echo "selected"; ?>>Female</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Update Profile</button>
    </form>
    <div class="mt-3">
        <a href="dashboard.php" class="btn btn-secondary w-100">Back to Dashboard</a>
    </div>
</div>

</body>
</html>

