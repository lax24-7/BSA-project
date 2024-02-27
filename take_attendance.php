<?php
// Check if the required form field (registrationNumber) is submitted
if (isset($_POST['registrationNumber'])) {
  // Retrieve the registration number from the form input
  $registrationNumber = $_POST['registrationNumber'];

  // Database configuration
  $host = "localhost";
  $database = "attendance_db";
  $username = "root";
  $password = "";

  try {
    // Create a database connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement to retrieve the textareaData, studentName, and studentID based on the registrationNumber
    $sql = "SELECT txtiso_template, student_name, registration_number, student_id FROM students WHERE registration_number = :registrationNumber";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':registrationNumber', $registrationNumber);
    $stmt->execute();

    // Fetch the row containing the textareaData, studentName, and studentID
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a row is found
    if ($row) {
      // Retrieve the textareaData, studentName, and studentID from the fetched row
      $textareaData = $row['txtiso_template'];
      $studentName = $row['student_name'];
      $registrationNumber = $row['registration_number'];
      $studentId = $row['student_id'];

      // Output the retrieved data into the textarea
      echo '<script>document.getElementById("txtIsoTemplate").value = "' . $textareaData . '";</script>';
    } else {
      // No matching registration number found
      echo "No student found with the given registration number.";
    }
  } catch (PDOException $e) {
    // Handle any database errors
    echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>TAKE ATENDANCE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/stud.css" rel="stylesheet">
    <link href="css/class.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <script src="js/side.js"></script>
    <script src="sdk/jquery-1.8.2.js"></script>
    <script src="sdk/mfs100.js"></script>
    <script src="js/match.js"></script>
    

</head>
<body>
<?php include "Includes/sidebar.php";?>
<div class="form-container">

       
<form method="POST" action="take_attendance.php">
<label for="registrationNumber">Registration Number:</label>
    <input type="text" id="register" name="registrationNumber" required>
    <button type="submit" >SELECT</button>

  </form>
  
  <label for="studentName">Student Name:</label>
  <input type="text" id="studentName" name="studentName" value="<?php echo isset($studentName) ? $studentName : ''; ?>" readonly> 
  <input type="text" hidden  id="studentId" name="studentId" value="<?php echo isset($studentId) ? $studentId : ''; ?>" readonly>
  <input type="text"hidden id="registrationNumber" name="registrationNumber" value="<?php echo isset($registrationNumber) ? $registrationNumber : ''; ?>" readonly>
  <textarea id="txtIsoTemplate" hidden  name="textareaData" style="width: 100%; height: 50px;" class="form-control" readonly><?php echo isset($textareaData) ? $textareaData : ''; ?></textarea>
  <video style="margin-left: 100px; padding:10px; height:120px; width:100px;" src="vid/7.mp4" autoplay loop muted></video>
  <br>
  <button type="submit"style="margin-left: 130px; padding:10px;" id="btnCaptureAndMatch" class="btn btn-primary btn-200" onclick="return Match()">Verify</button>
 </div>
            
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