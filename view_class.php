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

// Fetch the list of classes from the database for the current user
$classQuery = "SELECT * FROM class WHERE user_id = ?";
$classStmt = $mysqli->prepare($classQuery);
$classStmt->bind_param("id", $_SESSION['user_id']);
$classStmt->execute();
$classResult = $classStmt->get_result();
$classes = $classResult->fetch_all(MYSQLI_ASSOC);
$classStmt->close();

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Classes</title>
    <link href="css/view.css" rel="stylesheet">
    <link href="css/stud.css" rel="stylesheet">
    <link href="css/class.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        .btn-edit i {
            margin-right: 5px;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            /* Add other custom styles here as needed */
        }

        .btn-edit:hover {
            background-color: #45a049;
            /* Add other hover styles here as needed */
        }

        /* Style for the "Delete" button */
        .btn-delete {
            background-color: #f44336; /* Red color */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            /* Add other custom styles here as needed */
        }

        .btn-delete:hover {
            background-color: #d32f2f; /* Darker red color on hover */
            /* Add other hover styles here as needed */
        }

        /* Adjust the position of the icon */
        .btn-edit i,
        .btn-delete i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<?php include "Includes/sidebar.php";?>
    <h2>View Classes</h2>
    <table>
        <thead>
            <tr>
                <th>Class ID</th>
                <th>Class Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classes as $class) : ?>
                <tr>
                    <td><?php echo $class['class_id']; ?></td>
                    <td><?php echo $class['class_name']; ?></td>
                    <td>
                        <a href="edit_class.php?id=<?php echo $class['class_id']; ?>" class='btn-edit'><i class='fas fa-edit'>Edit</i></a>
                        <a href="delete_class.php?id=<?php echo $class['class_id']; ?>" class='btn-delete'><i class='fas fa-trash'>Delete</i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="js/side.js"></script>
</body>
</html>
