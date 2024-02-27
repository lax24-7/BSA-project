    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add student</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link href="css/class.css" rel="stylesheet">
         <script src="sdk/jquery-1.8.2.js"></script>
         <script src="sdk/mfs100.js"></script>
         <script src="js/capture.js"></script>
    </head>
    <body>
    <?php include "Includes/sidebar.php";?>
    <div class="form-container">  
    <form method="POST" action="servers/save_student.php">
    <label for="registrationNumber" >student name:</label>
        <input type="text" id="studentName" name="studentName" required>
        <label for="registrationNumber" style="color=green,strong">registration number:</label>
        <input type="text" id="registrationNumber" name="registrationNumber" required>
        <textarea id="txtIsoTemplate" name="textareaData"style="width: 100%; height:50px;"hidden  class="form-control"></textarea>
        <label for="phonenumber"style="color=green,strong">phone number:<lebel>
        <input type="text" id="registrationNumber" name="phoneNumber" required>
        <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

<input type="hidden" id="isoTemplate" name="isoTemplate" value="">

<div class="img-container">
            <img id="imgFinger" alt="Fingerprint Image"src="img/2.png" alt="2.png" width="110" height="120" class="my-image" id="image-1"></div>
            <input type="submit" id="btnCapture" value="Capture" class="add-student-button" onclick="return Capture()" /><div>
            <textarea id="txtIsoTemplate"  hidden  class="form-control"> </textarea><br>
            <button type="submit" style="align-content:center;" name="submit" class="btn btn-primary btn-100">Add Student</button></div>
        </form>
            
    <div class="panel" >
                    <input type="text" value="" id="txtStatus"hidden class="form-control" />
                    <input type="text" value="" id="txtImageInfo"hidden class="form-control" />
                    <textarea id="txtIsoTemplate" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
                    <textarea id="txtAnsiTemplate" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
                    <textarea id="txtIsoImage" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
                    <textarea id="txtRawData" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
                    <textarea id="txtWsqData" style="width: 100%; height:50px;"hidden  class="form-control"> </textarea>
                    <textarea id="txtPid" style="width: 100%; height:50px;" hidden class="form-control"> </textarea>
    <script src="js/side.js"></script>
    </body>
    </html>