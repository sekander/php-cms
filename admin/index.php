<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session before using $_SESSION

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

// Check if form is submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
  
    // Prepare the SQL query to prevent SQL injection
    $email = $_POST['email'];
    $password =  $_POST['password'];

    $hashed_password = hash('sha256', $password);

    // Use prepared statements for secure SQL queries
    // $query = 'SELECT * FROM users WHERE email = ? AND active = "Yes" LIMIT 1';
    $query = 'SELECT * FROM users WHERE email = ?  LIMIT 1';
    $stmt = mysqli_prepare($connect, $query);

    // Bind parameters (email is a string)
    mysqli_stmt_bind_param($stmt, 's', $email);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);

        // Check if the password matches using the stored password_hash
        if ($hashed_password === $record['password_hash']) {
        // if (password_verify($password, $record['password_hash'])) {
            $_SESSION['id'] = $record['user_id'];
            $_SESSION['email'] = $record['email'];
            $_SESSION['role'] = $record['role'];

            // Redirect to dashboard
            // header('Location: dashboard.php');
            header('Location: dashboard.php');
            exit();
        } else {
            // Password doesn't match
            set_message('Incorrect email and/or password');
            header('Location: index.php');
            exit();
        }
    } else {
        // Email not found
        set_message('Incorrect email and/or password');
        header('Location: index.php');
        exit();
    }
}

include('includes/header.php');
?>

<div style="max-width: 400px; margin:auto">
  <form method="post">
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" required>

    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <br>

    <input type="submit" value="Login">
  </form>
</div>

<?php
include('includes/footer.php');
?>
