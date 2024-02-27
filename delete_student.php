<?php
// Include your database configuration and connection code here
$host = "localhost";
$database = "attendance_db";
$username = "root";
$password = "";

if (isset($_GET['id'])) {
    try {
        $studentId = $_GET['id'];
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to delete the student record
        $stmt = $pdo->prepare("DELETE FROM students WHERE student_id = :studentId");
        $stmt->bindParam(':studentId', $studentId);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Student record deleted successfully, redirect back to view_student.php
            header("Location: view_student.php");
            exit();
        } else {
            echo "Failed to delete student record.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid student ID.";
}
?>
