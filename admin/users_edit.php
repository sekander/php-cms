<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: users.php' );
  die();
  
}

if( isset( $_POST['username'] ) )
{
  
  if( $_POST['username'] && $_POST['email'] && $_POST['role'])
  {
    
    $query = 'UPDATE users SET
      username = "'.mysqli_real_escape_string( $connect, $_POST['username'] ).'",
      email = "'.mysqli_real_escape_string( $connect, $_POST['email'] ).'",
      role = "'.mysqli_real_escape_string( $connect, $_POST['role'] ).'"
      WHERE user_id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    if( $_POST['password'] )
    {
      
      $query = 'UPDATE users SET
        password_hash = "'.hash('sha256', $_POST['password']).'"
        WHERE user_id = '.$_GET['id'].'
        LIMIT 1';
      mysqli_query( $connect, $query );
      
    }
    
    set_message( 'User has been updated' );
    
  }

  header( 'Location: users.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM users
    WHERE user_id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: users.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit User</h2>

<form method="post">
  
  <label for="username">Username:</label>
  <input type="text" name="username" id="username" value="<?php echo htmlentities( $record['username'] ); ?>">
  
  <br>
  
  <label for="email">Email:</label>
  <input type="email" name="email" id="email" value="<?php echo htmlentities( $record['email'] ); ?>">
  
  <br>
  
  <label for="password">Password:</label>
  <input type="password" name="password" id="password">
  
  <br>
  
  <label for="role">Role:</label>
  <select name="role" id="role" required>
    <option value="artist">Artist</option>
    <option value="admin">Admin</option>
    <option value="user">User</option>
    <!-- You can add more roles as needed -->
  </select>
  
  <br>
  
  <label for="active">Active:</label>
  <br>
  
  <input type="submit" value="Edit User">
  
</form>

<p><a href="users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>


<?php

include( 'includes/footer.php' );

?>