<?php
session_start();

$cookieName = 'loggedInName';
$cookiePassword = 'loggedInPassword';
$cookieretypedPass = 'retypedPass';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the login details from the form
    $loggedInName = $_POST['loggedInName'];
    $password = $_POST['password'];
    $retypedPass = $_POST['retypedPass'];

    // Check for valid password match (for this example)
    if ($password === $retypedPass) {
        // Establish a database connection
        $servername = "localhost";  // Change this if your MySQL server is running on a different host
        $username = "root";         // Your MySQL username (default is often 'root' in XAMPP)
        $dbPassword = "";           // Your MySQL password (leave it empty if there's no password set)
        $database = "survey_form";  // Replace 'survey_form' with your database name

        // Create a connection
        $conn = new mysqli($servername, $username, $dbPassword, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare an SQL query to insert the login details into the 'log_in' table
        $sql = "INSERT INTO log_in (name, password)
                VALUES ('$loggedInName', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Set cookies and session variables as before
            setcookie($cookieName, $loggedInName); 
            setcookie($cookiePassword, $password); 
            setcookie($cookieretypedPass, $retypedPass);

            $_SESSION['loggedInName'] = $loggedInName;
            $_SESSION['password'] = $password;
            $_SESSION['retypedPass'] = $retypedPass;

            // Redirect to your desired page
            header("Location: my-project.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        header("Location: http://localhost:8000/log-in.html");
        exit();
    }
} else {
    header("Location: http://localhost:8000/log-in.html");
    exit();
}
?>
