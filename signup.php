<?php
// Database connection
$host = 'localhost';
$db = 'dentist';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$errorMessage = '';
$suggestions = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];

    // Check if username exists
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errorMessage = "Username already exists. try:";

        // Generate username suggestions
        for ($i = 1; $i <= 2; $i++) {
            $suggestions[] = $username . $i; // Suggest username with a number
        }

        // Redirect with error message and suggestions
        $stmt->close();
        $conn->close();
        header('Location: index.php?error=' . urlencode($errorMessage) . '&suggestions=' . urlencode(json_encode($suggestions)));
        exit();
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, username, email, gender, date, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $username, $email, $gender, $birthday, $address);
        $stmt->execute();

        // Redirect or display success message (optional)
        header('Location: index.php?success=true');
        exit();
    }
}

$conn->close();
