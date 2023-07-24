<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact_us";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "Successfully connected to the MySQL server.<br>";
}

$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($conn, $sql)) {
    // echo "Database created successfully or already exists.<br>";
    
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

mysqli_select_db($conn, $database);

$sql = "CREATE TABLE IF NOT EXISTS contact_us (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    eligible ENUM('Yes', 'No') NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    description TEXT
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $eligible = $_POST['eligible'];
    $gender = $_POST['gender'];
    $description = $_POST['description'];

    $sql = "INSERT INTO contact_us (first_name, last_name, email, eligible, gender, description) 
            VALUES ('$first_name', '$last_name', '$email', '$eligible', '$gender', '$description')";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success" role="alert">
        Hi, Your Record inserted successfully </div>';
    } else {
        echo "Error inserting record: " . mysqli_error($conn) . "<br>";
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 pt-5">
        <form action="index.php" method="post" >
            <div class="row">
                <div class="col-12 text-center">
                    <h4><strong>Contact us:</strong></h4>
                </div>
                <div class="col-12 mb-5">
                    <a href="index.php">Home Page</a> </br>
                    <a href="list_contact.php">List Page</a>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name </label>
                        <input type="fname" class="form-control" name="fname" id="fname" aria-describedby="fnameHelp">
                        <div id="fnameHelp" class="form-text">We'll never share your first name with anyone else.</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="lname" class="form-control" name="lname" id="lname" aria-describedby="lnameHelp">
                        <div id="lnameHelp" class="form-text">We'll never share your last name with anyone else.</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email addresh</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="eligible" class="form-label">Eligible</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eligible" value="Yes"
                                    id="eligibleYes">
                                <label class="form-check-label" for="eligibleYes">
                                    Yes, I am eligible.
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eligible" value="No"
                                    id="eligibleNo">
                                <label class="form-check-label" for="eligibleNo">
                                    No, I am not eligible.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <select class="form-select mb-3" name="gender" aria-label="Default select example">
                        <option selected>Select you gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripstion</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                      </div>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
