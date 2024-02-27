<!-- signup.php -->

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
    $confirmPassword = md5(sha1($_POST['confirm_password']));

    // Perform input validation
    $errors = array();

    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    if (count($errors) === 0) {
        // Perform user registration
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        // Redirect to the login page after successful registration
        header('Location: login.php');
        exit;

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link href="css/add.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
<div class="form-container">
<h2>Sign Up</h2>

<?php if (isset($errors) && count($errors) > 0) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<style>
    .add-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .add-button:hover {
        background-color: #45a049;
    }
</style>

<form action="signup.php" method="POST">
    <div class="form-group">
        <label for="username"><i class="fas fa-user"></i> Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password"><i class="fas fa-lock"></i> Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="confirm_password"><i class="fas fa-lock"></i> Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <div class="form-group">
        <button class="add-button" type="submit"><i class="fas fa-sign-in-alt"></i> Sign Up</button>
    </div>
</form>

</div>
</body>
</html>