<?php
// Include your database configuration and connection code here
$host = "localhost";
  $database = "attendance_db";
  $username = "root";
  $password = "";

if (isset($_GET['id'])) {
    try {
        $classId = $_GET['id'];
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Delete the class record from the database based on the class ID
        $stmt = $pdo->prepare("DELETE FROM class WHERE class_id = :classId");
        $stmt->bindParam(':classId', $classId);
        $stmt->execute();

        // Redirect back to the view_class.php page after deletion
        header("Location: view_class.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid class ID.";
}
?>
