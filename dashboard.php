<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="css/dashy.css" rel="stylesheet">
    <link href="css/class.css" rel="stylesheet">

   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <script src="js/side.js"></script>
</head>
<body>
<?php include "Includes/sidebar.php";?>
     <div class="content">
        <!-- Your page content goes here -->
        <h2>Welcome to the Dashboard</h2>
    </div>
        <?php
        // Database connection setup
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'attendance_db';

        $conn = mysqli_connect($host, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to retrieve the data
        $studentCountQuery = "SELECT COUNT(*) AS studentCount FROM students";
        $classCountQuery = "SELECT COUNT(*) AS classCount FROM class";
        $attendanceCountQuery = "SELECT COUNT(*) AS attendanceCount FROM attendance";

        $studentResult = mysqli_query($conn, $studentCountQuery);
        $classResult = mysqli_query($conn, $classCountQuery);
        $attendanceResult = mysqli_query($conn, $attendanceCountQuery);

        // Check query results
        if (mysqli_num_rows($studentResult) > 0 && mysqli_num_rows($classResult) > 0 && mysqli_num_rows($attendanceResult) > 0) {
            $studentCount = mysqli_fetch_assoc($studentResult)['studentCount'];
            $classCount = mysqli_fetch_assoc($classResult)['classCount'];
            $attendanceCount = mysqli_fetch_assoc($attendanceResult)['attendanceCount'];

            // Display the data
            echo '<div class="data-container">';
            echo '<div class="data-box">';
            echo '<h4>Number of Students</h4>';
            echo '<p><i class="fas fa-user-graduate"></i>  :  '. $studentCount . '</p>';
            echo '</div>';

            echo '<div class="data-box">';
            echo '<h4>Number of Classes</h4>';
            echo '<p><i class="fas fa-chalkboard"></i> : ' . $classCount . '</p>';
            echo '</div>';

            echo '<div class="data-box">';
            echo '<h4>Attendance Statistics</h4>';
            echo '<p><i class="fas fa-calendar-check"></i>  Total Attendance: ' . $attendanceCount . '</p>';
            // You can display more statistics here as needed
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No data available.';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
    <script src="/js/side.js"></script>
</html>
