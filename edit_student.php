<?php
// Include your database configuration and connection code here
$host = "localhost";
$database = "attendance_db";
$username = "root";
$password = "";
?>
<?php
if (isset($_GET['id'])) {
    try {
        $studentId = $_GET['id'];
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch student record from the database based on the student ID
        $stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = :studentId");
        $stmt->bindParam(':studentId', $studentId);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$student) {
            echo "Invalid student ID.";
        } else {
            // The student record is retrieved, and you can display the form for editing here.
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Edit Student</title>
                <link href="css/view.css" rel="stylesheet">
                <link href="css/stud.css" rel="stylesheet">
                <link href="css/class.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
                <script src="js/side.js"></script>
                <script src="sdk/jquery-1.8.2.js"></script>
                <script src="sdk/mfs100.js"></script>
                <script src="js/capture.js"></script>
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
        h5{
            color:black;
        }
    </style>
</head>
<body>
<?php include "Includes/sidebar.php";?>
                <h1>Edit Student</h1>
                <form action="servers/update_student.php" method="POST">
                    <input type="hidden" name="studentId" value="<?php echo $student['student_id']; ?>">
                    <div class="form-group">
                        <label for="studentName"><h5>Student Name:</h5></label>
                        <input type="text" id="studentName" name="studentName" value="<?php echo $student['student_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="registrationNumber"><h5>Registration Number:</h5></label>
                        <input type="text" id="registrationNumber" name="registrationNumber" value="<?php echo $student['registration_number']; ?>" required>
                    </div>
                    <div class="form-group">
                        <textarea id="txtIsoTemplate" hidden name="txtIsoTemplate" style="width: 100%; height: 100px;"><?php echo $student['txtIso_template']; ?></textarea>
                    </div>
        <div class="img-container">          
                    <img id="imgFinger" alt="Fingerprint Image"src="img/2.png" alt="2.png" width="110" height="120" class="my-image" id="image-1"></div>
                    <input type="submit" id="btnCapture" value="Capture" class="add-student-button" onclick="return Capture()" /><div>
            <textarea id="txtIsoTemplate"  hidden  class="form-control"> </textarea><br>
       </div>
                    <button type="submit">Update Student</button>
                </form>
                        
    <div class="panel" >
                    <input type="text" value="" id="txtStatus"hidden class="form-control" />
                    <input type="text" value="" id="txtImageInfo"hidden class="form-control" />
              
            <!--<tr>
                <td>
                    NFIQ:
                </td>
                <td>
                    <input type="text" value="" id="txtNFIQ" class="form-control" />
                </td>
            </tr>-->
         
                   <!-- Base64Encoded ISO Template-->
          
                    <textarea id="txtIsoTemplate" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
   
          
                    <!--Base64Encoded ANSI Template-->
               
                    <textarea id="txtAnsiTemplate" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
            
                    <!--Base64Encoded ISO Image-->
            
                    <textarea id="txtIsoImage" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>

          
                    <!--Base64Encoded Raw Data-->
              
                    <textarea id="txtRawData" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
       
                    <!--Base64Encoded Wsq Image Data-->
               
                    <textarea id="txtWsqData" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
             
                    <!--Encrypted Base64Encoded Pid/Rbd-->

                    <textarea id="txtPid" style="width: 100%; height:50px;" hidden class="form-control"> </textarea>
</body>
            </html>
            <?php
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid student ID.";
}
?>
