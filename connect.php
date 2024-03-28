<?php
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$pass = $_POST["pass"];

// Database connection
$conn = new mysqli('localhost','root','','general');
if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO login (fname, lname, email, pass) VALUES (?, ?, ?, ?)");
    
    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssss", $fname, $lname, $email, $pass);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement.";
    }

    // Close the connection
    $conn->close();
}
?>
