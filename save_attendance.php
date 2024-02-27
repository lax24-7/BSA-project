<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the student name, registration number, and student ID from the form data
    $studentName = $_POST['studentName'];
    $registrationNumber = $_POST['registrationNumber'];
    $studentId = $_POST['studentId'];

    // Database configuration
    $host = "localhost";
    $database = "attendance_db";
    $username = "root";
    $password = "";

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

        // Prepare the SQL statement to insert the data into the database
        $sql = "INSERT INTO attendance (user_id, student_name, registration_number, student_id) VALUES (:user_id, :studentName, :registrationNumber, :studentId)";
        $stmt = $pdo->prepare($sql);

        // Get the user_id from the session
        session_start();
        $user_id = $_SESSION['user_id'];

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':studentName', $studentName);
        $stmt->bindParam(':registrationNumber', $registrationNumber);
        $stmt->bindParam(':studentId', $studentId);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo "Data inserted successfully";
        } else {
            echo "Failed to insert data";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
