<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Send email
    $to = "sachinmandal726@gmail.com";
    $subject = "Contact request from personal website";
    $headers = "From: $email\r\n";
    mail($to, $subject, $message, $headers);

    // Save to database (using MySQLi for simplicity)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portfolio";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO contact_form_data (email, message) VALUES ('$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
