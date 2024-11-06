<?php
// Database connection
$host = 'localhost';
$db = 'dentist';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve appointments
$sql = "SELECT a.username, a.date, a.time, 
               u.name, u.email, u.gender, u.date, u.address 
        FROM appointments a 
        JOIN users u ON a.username = u.username";

$result = $conn->query($sql);

$appointments = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'name' => htmlspecialchars($row['name']),
            'appointment_date' => htmlspecialchars($row['date']),
            'appointment_time' => htmlspecialchars($row['time']),
            'email' => htmlspecialchars($row['email']),
            'gender' => htmlspecialchars($row['gender']),
            'date_of_birth' => htmlspecialchars($row['date']),
            'address' => htmlspecialchars($row['address']),
        ];
    }
}

// Set header to JSON
header('Content-Type: application/json');

// Save JSON to local file
$file = 'appointments.json';
$currentData = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Compare and update if necessary
if ($appointments !== $currentData) {
    file_put_contents($file, json_encode($appointments, JSON_PRETTY_PRINT));
}

// Output JSON
echo json_encode($appointments);

$conn->close();
