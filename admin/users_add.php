<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['username'])) {
  
  if ($_POST['username'] && $_POST['email'] && $_POST['password'] && $_POST['role']) {

    // Use prepared statements to prevent SQL injection
    $query = 'INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)';

    // Prepare statement
    if ($stmt = mysqli_prepare($connect, $query)) {

      // Hash the password
      $password_hash = hash('sha256', $_POST['password']);
      
      // Bind parameters
      mysqli_stmt_bind_param($stmt, "ssss", $_POST['username'], $_POST['email'], $password_hash, $_POST['role']);

      // Execute query
      if (mysqli_stmt_execute($stmt)) {
        set_message('User has been added');
      } else {
        // Error executing query
        set_message('Error: ' . mysqli_error($connect));
      }

      // Close statement
      mysqli_stmt_close($stmt);
    } else {
      set_message('Error preparing query: ' . mysqli_error($connect));
    }

  } else {
    set_message('All fields are required');
  }

  // Debugging: Check if POST variables and query are as expected
  // print_r($_POST);
  // die();

  header('Location: users.php');
  die();
}

include('includes/header.php');
?>

<h2>Add User</h2>

<form method="post">
  
  <label for="username">Username:</label>
  <input type="text" name="username" id="username" required>
  
  <br>
  
  <label for="email">Email:</label>
  <input type="email" name="email" id="email" required>
  
  <br>
  
  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required>
  
  <br>
  
  <label for="role">Role:</label>
  <select name="role" id="role" required>
    <option value="artist">Artist</option>
    <option value="admin">Admin</option>
    <option value="user">User</option>
    <!-- You can add more roles as needed -->
  </select>
  
  <br>
  
  
  <input type="submit" value="Add User">
  
</form>

<p><a href="users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>

<?php

include('includes/footer.php');
?>
