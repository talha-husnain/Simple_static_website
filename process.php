<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a database connection
    $servername = "localhost";  // Change this if your MySQL server is running on a different host
    $username = "root";         // Your MySQL username (default is often 'root' in XAMPP)
    $password = "";             // Your MySQL password (leave it empty if there's no password set)
    $database = "survey_form";  // Replace 'survey_form' with your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);
    

    // $conn = new mysqli("localhost", 'root', '', 'survey_form');



    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process and store the form data in the database
    $q1 = $_POST['q1'];
    $q1_other_details = $_POST['q1_other_details'];
    $q2 = $_POST['q2'];
    $q2_other_details = $_POST['q2_other_details'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];

    // Prepare an SQL query to insert the data into the 'survey' table
    $sql = "INSERT INTO survey (q1, q1_other_details, q2, q2_other_details, q3, q4)
            VALUES ('$q1', '$q1_other_details', '$q2', '$q2_other_details', '$q3', '$q4')";

    if ($conn->query($sql) === TRUE) {
        echo "  Form Submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST, redirect back to the form page
    header("Location: http://localhost:8000/survey_form.html");
    exit();
}
?>
