<?php
// Your database connection configuration
$host = "localhost";
$database = "attendance_db";
$username = "root";
$password = "";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch attendance data from the database
    $stmt = $pdo->query("SELECT * FROM attendance");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate the CSV content
    $csvContent = "Date,Student Name,Registration Number,Time\n";
    foreach ($data as $row) {
        $csvContent .= $row['attendance_time'] . ',' . $row['student_name'] . ',' . $row['registration_number'] .',' .$row['time'] . "\n";
    }

    // Set the HTTP headers to force the browser to download the file
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=attendance.csv");

    // Output the CSV content to the browser
    echo $csvContent;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
