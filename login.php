<!-- login.php -->

<?php
session_start();
require_once 'database.php';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard or home page
    header('Location: dashboard.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5(sha1($_POST['password']));

    // Perform input validation
    $errors = array();

    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if (count($errors) === 0) {
        // Perform user authentication
        $query = "SELECT user_id FROM users WHERE username = ? AND password = ?";
        $stmt = $mysqli->prepare($query);
    
        if (!$stmt) {
            die("Error preparing statement: " . $mysqli->error);
        }
    
        $stmt->bind_param("ss", $username, $password);
    
        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }
    
        $stmt->bind_result($userId);
        $stmt->fetch();
        $stmt->close();
    
        if ($userId) {
            // Store the user ID in the session
            $_SESSION['user_id'] = $userId;
    
            // Redirect to the dashboard or home page
            header('Location: dashboard.php');
            exit;
        } else {
            $errors[] = "Invalid username or password";
        }
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/add.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordVisibilityToggle = document.getElementById("password-toggle");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordVisibilityToggle.innerText = "Hide";
            } else {
                passwordInput.type = "password";
                passwordVisibilityToggle.innerText = "Show";
            }
        }
    </script>
</head>
<body>
<div class="form-container">
<h2>Login</h2>
<?php if (isset($errors) && count($errors) > 0) : ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <style>
    .add-student-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .add-student-button:hover {
        background-color: #45a049;
    }

    .signup-link {
        color: #888;
    }

    .signup-link a {
        color: #4CAF50;
        text-decoration: none;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    .button-icon {
        margin-right: 5px;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<form action="login.php" method="POST">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <div class="password-input">
            <input type="password" id="password" name="password" required>
            <button type="button" id="password-toggle" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>
    <br>
    <br>
    <div class="form-group">
        <button class="add-student-button" type="submit">
            <i class="fas fa-sign-in-alt button-icon"></i>
            Log In
        </button>
    </div>
    <div class="signup-link">
        <h4>Not registered? <a href="signup.php"><i class="fas fa-user-plus"></i> Sign up</a></h4>
    </div>
</form>

</body>
</html>