<?php
// Your database connection configuration
$host = "localhost";
$database = "attendance_db";
$username = "root";
$password = "";

if (isset($_GET['data'])) {
    $attendanceData = unserialize(urldecode($_GET['data']));

    // Generate the CSV content
    $csvContent = "Date,Student Name,Registration Number,Time\n";
    foreach ($attendanceData as $row) {
        $csvContent .= $row['attendance_time'] . ',' . $row['student_name'] . ',' . $row['registration_number'] . ','. $row['time'] ."\n";
    }

    // Set the HTTP headers to force the browser to download the file
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=attendance.csv");

    // Output the CSV content to the browser
    echo $csvContent;
} else {
    echo "No attendance data found.";
}
?>
