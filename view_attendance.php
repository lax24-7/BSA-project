<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <link href="css/view.css" rel="stylesheet">
    <link href="css/stud.css" rel="stylesheet">
    <link href="css/.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
    <?php include "Includes/sidebar.php"; ?>
    <div class="view">
        <h2>View Attendance</h2>
        <form method="POST" action="" class="contena">
            <div class="form-group">
                <label for="className" style="margin-right: 20px;">Class Name:</label>
                <input type="text" id="className" name="className" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-view"></i>View</button>
            <a href="generate_excel.php" class="btn btn-primary"><i class="fas fa-download"></i>download</a>
        </form>
        <script src="js/side.js"></script>
    </div>

    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the class name and date from the form data
        $className = $_POST['className'];
        $date = $_POST['date'];

        // Database configuration
        $host = "localhost";
        $database = "attendance_db";
        $username = "root";
        $password = "";

        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Retrieve the user_id from the session (assuming it is stored in the session)
            session_start();
            $userId = $_SESSION['user_id'];

            // Prepare the SQL statement to retrieve the attendance records for the given user, class, and date
            $sql = "SELECT students.student_name, students.registration_number 
                    FROM students 
                    INNER JOIN class_student ON students.student_id = class_student.student_id
                    INNER JOIN class ON class_student.class_id = class.class_id
                    INNER JOIN attendance ON students.student_id = attendance.student_id
                    WHERE class.class_name = :className AND attendance.attendance_time = :date AND students.user_id = :userId";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':className', $className);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            // Fetch the attendance records
            $attendanceRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if any records are found
            if ($attendanceRecords) {
                // Display the attendance records
                echo "<h3>Attendance Records for Class: $className, Date: $date</h3>";
                echo "<table>";
                echo "<tr><th>Student Name</th><th>Registration Number</th></tr>";
                foreach ($attendanceRecords as $record) {
                    $studentName = $record['student_name'];
                    $registrationNumber = $record['registration_number'];
                    echo "<tr><td>$studentName</td><td>$registrationNumber</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>No attendance records found for the given class and date.</h3>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
</body>
</html>
