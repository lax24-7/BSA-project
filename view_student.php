<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link href="css/stud.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <style>
        /* Add your custom CSS styles here */

        /* ... */

        body {
            background-color: black;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            background-color: gray;
            text-align: right;
            margin-left: 300px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: white;
        }

        th {
            background-color: darkgray;
            color: black;
            font-weight: bold;
        }

        .add-button {
            margin-bottom: 20px;
        }

        .add-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: green;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .add-button a:hover {
            background-color: #0069d9;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration-style: solid;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #45a049;
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
            text-decoration-style: solid;
            text-decoration: none;
            
        }

        .btn-delete:hover {
            background-color: #d32f2f; /* Darker red color on hover */
        }

        /* Adjust the position of the icon */
        .btn-edit i,
        .btn-delete i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php include "Includes/sidebar.php"; ?>
    <h2>View Students</h2>

    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Registration Number</th>
            <th>Action</th>
        </tr>
        <!-- PHP code to fetch and display student records -->
        <?php
        // Include the database connection file
        include 'servers/config.php';

        // Fetch student records from the database
        $sql = "SELECT * FROM students WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any records exist
        if ($result->num_rows > 0) {
            // Loop through each row of the result set
            while ($row = $result->fetch_assoc()) {
                $studentId = $row['student_id'];
                $studentName = $row['student_name'];
                $registrationNumber = $row['registration_number'];

                // Output the student information in a table row
                echo "<tr>";
                echo "<td>$studentId</td>";
                echo "<td>$studentName</td>";
                echo "<td>$registrationNumber</td>";
                echo "<td>
                        <a href='edit_student.php?id=$studentId' class='btn-edit'><i class='fas fa-edit'></i>Edit</a>
                        <a href='delete_student.php?id=$studentId' class='btn-delete'><i class='fas fa-trash'></i>Delete</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            // If no records exist, display a message
            echo "<tr><td colspan='4'>No students found.</td></tr>";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
        ?>
    </table>
    <script src="js/side.js"></script>
</body>
</html>
