<?php
// Database connection
$servername = "localhost"; // Your server, usually localhost
$username = "root";        // Your MySQL username
$password = "";            // Your MySQL password
$dbname = "gowthamdb";   // Your database name

// Create  database connection 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted using POST method dont change $server variable its default
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nameofcust = $_POST['name'];
    $ageofcust = $_POST['age'];
    $citycust = $_POST['city'];

    // Prepare and bind the SQL query to avoid SQL injection
    $insert = $conn->prepare("INSERT INTO customer (name, age, city) VALUES (?, ?, ?)");
    $insert->bind_param("sis", $nameofcust, $ageofcust, $citycust); // 's' = string, 'i' = integer

    // Execute the query and check if successful
    if ($insert->execute()) {
        echo "New record created successfully!<br>";
    } else {
        echo "Error: " . $insert->error;
    }

    $insert->close();
}

$conn->close();
?>