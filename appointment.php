<?php
// Database connection
$host = 'localhost';
$db = 'dentist';
$user = 'root';
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$errorMessage = '';
$successMessage = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['full_name'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];

    // Check if username exists in users table
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $errorMessage = "Username not found. Please sign up first.";
    } else {
        // Insert new appointment into the database
        $stmt->close(); // Close the previous statement
        $stmt = $conn->prepare("INSERT INTO appointments (username, date, time) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $appointmentDate, $appointmentTime);

        if ($stmt->execute()) {
            $successMessage = "Appointment successfully booked!";
        } else {
            $errorMessage = "Error booking appointment: " . $stmt->error;
        }
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Appointment Confirmation</title>
</head>

<body>
    <h1>Appointment Status</h1>

    <?php if ($successMessage) : ?>
        <p style="color: green;"><?php echo htmlspecialchars($successMessage); ?></p>
    <?php endif; ?>
    <?php if ($errorMessage) : ?>
        <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php endif; ?>

    <a href="index.php">Back to Appointment Form</a>
</body>

</html>