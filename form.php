<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact_us";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Successfully connected to the MySQL server.<br>";
}

$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully or already exists.<br>";
    
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
    echo "Table created successfully or already exists.<br>";
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
        echo "Hi, $first_name! Your Record inserted successfully.<br>";
        echo '<a href="index.php">Home Page</a> </br>';
        echo '<a href="list_contact.php">List Page</a>';
    } else {
        echo "Error inserting record: " . mysqli_error($conn) . "<br>";
    }
}

mysqli_close($conn);
?>