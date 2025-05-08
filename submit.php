<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$host = "ksusalinawebdev.net";
$user = "Contact_user";
$pass = "N_#+DJeO%sE%";
$db = "contactUs";

// Create a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute prepared statements
function executeQuery($conn, $query, $types, $params) {
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }
    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        $stmt->close();
        return false;
    }
    $stmt->close();
    return true;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $firstName = trim($_POST['fName']);
    $lastName = trim($_POST['lName']);
    $org = trim($_POST['org']);
    $email = trim($_POST['email']);
    $comments = trim($_POST['comments']);

    // Basic validation
    if (empty($firstName) || empty($lastName) || empty($email)) {
        echo "All required fields must be filled out.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if (strlen($firstName) > 45 || strlen($lastName) > 45) {
        echo "First and last names must not exceed 45 characters.";
        exit;
    }

    if (!empty($comments) && strlen($comments) > 255) {
        echo "Comments must not exceed 255 characters.";
        exit;
    }

    // Insert data into tables
    $success = true;
    $success &= executeQuery($conn, "INSERT INTO UserName (firstName, lastName) VALUES (?, ?)", "ss", [$firstName, $lastName]);
    $success &= executeQuery($conn, "INSERT INTO Organization (org) VALUES (?)", "s", [$org]);
    $success &= executeQuery($conn, "INSERT INTO Contact (email) VALUES (?)", "s", [$email]);
    $success &= executeQuery($conn, "INSERT INTO Commentary (comments) VALUES (?)", "s", [$comments]);

    if ($success) {
        echo "Message submitted successfully!";
    } else {
        echo "An error occurred while submitting your message. Please try again later.";
    }
}

// Close the database connection
$conn->close();
?>