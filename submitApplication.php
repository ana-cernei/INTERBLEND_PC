<?php
// Include the database connection file
include 'partials/_dbconnect.php';

// Start the session to access session variables
session_start();

// Define a function to handle redirection with a status message
function redirect_with_message($page, $msg) {
    header("Location: $page?status=$msg");
    exit(); // Stop further executing script
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect to the login page
    redirect_with_message('login.php', 'nologin');
}

// Extract user ID from session
$userId = $_SESSION['userId'];

// Check if the form data is being sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and escape to prevent SQL Injection
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $education = mysqli_real_escape_string($conn, $_POST['education']);
    $experience = (int)$_POST['experience'];  // Cast as integer for safety

    // SQL query to insert data into the 'orders' table including the userId
    $sql = "INSERT INTO orders (userId, phoneNo, skills, languages, education, experience) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters to the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Binding parameters to the prepared statement
        $stmt->bind_param("issssi", $userId, $phone, $skills, $language, $education, $experience);

        // Execute the prepared statement and check for success
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            redirect_with_message('index.php', 'success');
        } else {
            $error = $stmt->error;
            $stmt->close();
            $conn->close();
            redirect_with_message('index.php', 'error&errorMsg=' . urlencode($error));
        }
    } else {
        $error = $conn->error;
        $conn->close();
        redirect_with_message('index.php', 'error&errorMsg=' . urlencode($error));
    }
} else {
    // Not a POST request, handle error or redirect
    redirect_with_message('index.php', 'invalidrequest');
}
?>
