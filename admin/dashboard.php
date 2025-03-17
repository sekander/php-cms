
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );


secure();


include( 'includes/header.php' );


// Get the user's role from the session
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Unknown';  // Default to 'Unknown' if the role is not set


?>
<h1>Dashboard</h1>

<!-- Display user role -->
<p>Welcome, your role is: <?php echo htmlspecialchars($user_role); ?></p>


<!-- Dashboard -->
<?php if ($user_role == "admin"): ?>
<ul id="dashboard">
  <li>
    <a href="users.php">
    <!-- <a href="adimin-role/users.php"> -->
      Manage Users
    </a>
  </li>
  <li>
    <a href="logout.php">
      Logout
    </a>
  </li>
</ul>
<?php elseif ($user_role == "artist"): ?>
  <ul id="dashboard">
    <li>
      <!-- <a href="projects.php"> -->
      <a href="projects.php">
        Manage Projects
      </a>
    </li>
    <li>
      <a href="logout.php">
        Logout
      </a>
    </li>
  </ul>
<?php endif; ?>





<?php

include( 'includes/footer.php' );

?>
