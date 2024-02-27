<?php
session_start();
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'attendance_db';

// Create a new MySQLi instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Fetch the list of students from the database for the current user
$studentQuery = "SELECT * FROM students WHERE user_id = ?";
$studentStmt = $mysqli->prepare($studentQuery);
$studentStmt->bind_param("i", $_SESSION['user_id']);
$studentStmt->execute();
$studentResult = $studentStmt->get_result();
$students = $studentResult->fetch_all(MYSQLI_ASSOC);
$studentStmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the class name and assigned students from the form data
    $className = $_POST['className'];
    $assignedStudents = isset($_POST['assignedStudents']) ? $_POST['assignedStudents'] : [];

    // Validate and process the data, insert into the database
    if (!empty($className) && !empty($assignedStudents)) {
        // Insert the class into the database
        $classInsertSql = "INSERT INTO class (class_name, user_id) VALUES (?, ?)";
        $classInsertStmt = $mysqli->prepare($classInsertSql);
        $classInsertStmt->bind_param("si", $className, $_SESSION['user_id']);
        $classInsertStmt->execute();

        // Get the inserted class ID
        $classId = $mysqli->insert_id;

        // Insert the assigned students into the class_student table
        $studentInsertSql = "INSERT INTO class_student (class_id, student_id) VALUES (?, ?)";
        $studentInsertStmt = $mysqli->prepare($studentInsertSql);

        foreach ($assignedStudents as $studentId) {
            $studentInsertStmt->bind_param("ii", $classId, $studentId);
            $studentInsertStmt->execute();
        }

        // Confirmation message
        echo '<p>Class "' . $className . '" created and students assigned successfully!</p>';
    } else {
        echo "Please provide a class name and select at least one student.";
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Add Class and Assign Students</title>
    <link href="css/class.css" rel="stylesheet">
    <link href="css/stud.css" rel="stylesheet">
    <link href="css/view.css" rel="stylesheet">
    <script src="js/side.js"></script>
</head>
<body>
<?php include "Includes/sidebar.php";?>

<h2>Add Class and Assign Students</h2>
<form method="POST">
    <div class="contena">
        <div class="form-group"> 
            <label for="className">Class Name:</label>
            <input type="text" id="className" name="className" required>
        </div>
        <div class="form-group"> 
            <button type="submit" class="btn btn-primary">Add Class and Assign Students</button>
        </div>    
    </div>

    <table class="student-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Registration Number</th>
                <th>Assign</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td><?php echo $student['student_id']; ?></td>
                    <td><?php echo $student['student_name']; ?></td>
                    <td><?php echo $student['registration_number']; ?></td>
                    <td>
                        <label class="student-checkbox">
                            <input type="checkbox" name="assignedStudents[]" value="<?php echo $student['student_id']; ?>">
                        </label>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br><br>
</form>
   
</body>
</html>
