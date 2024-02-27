<!DOCTYPE html>
<html>
<head>
    <title>Edit Class</title>
    <style>
        body {
          
            margin: 0;
            padding: 0;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
 
<link href="css/view.css" rel="stylesheet">
  <link href="css/stud.css" rel="stylesheet">
  <link href="css/class.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="js/side.js"></script>
</head>
<body>
<?php include "Includes/sidebar.php";?>
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

            // Fetch class record from the database based on the class ID
            $stmt = $pdo->prepare("SELECT * FROM class WHERE class_id = :classId");
            $stmt->bindParam(':classId', $classId);
            $stmt->execute();
            $class = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$class) {
                echo "Invalid class ID.";
            } else {
                // The class record is retrieved, and you can display the form for editing here.
                ?>
                <h1>Edit Class</h1>
                <form action="edit_class.php" method="POST">
                    <input type="hidden" name="classId" value="<?php echo $class['class_id']; ?>">
                    <div class="form-group">
                        <label for="className">Class Name:</label>
                        <input type="text" id="className" name="className" value="<?php echo $class['class_name']; ?>" required>
                    </div>
                    <button type="submit">Update Class</button>
                </form>
                <?php
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid class ID.";
    }
    ?>
    <?php
// Include your database configuration and connection code here
$host = "localhost";
$database = "attendance_db";
$username = "root";
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve the class ID and new class name from the form data
        $classId = $_POST['classId'];
        $newClassName = $_POST['className'];

        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to update the class record in the database
        $sql = "UPDATE class SET class_name = :newClassName WHERE class_id = :classId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':newClassName', $newClassName);
        $stmt->bindParam(':classId', $classId);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo "<script>alert('Class record updated successfully.'); window.location.href = 'view_class.php';</script>";
            exit;
    
        } else {
            echo "Failed to update class record.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

    <script src="js/side.js"></script>
</body>
</html>
