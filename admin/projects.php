<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  $artwork_id = $_GET['delete'];

  // Deleting artwork by artwork_id
  $query = 'DELETE FROM artworks
            WHERE artwork_id = '.$artwork_id.'
            LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Project has been deleted' );
  
  header( 'Location: projects.php' );
  die();
}

include( 'includes/header.php' );

// Query to select artworks by a specific artist
//$artist_id = 2956; // This should be dynamic based on logged-in artist or user
$artist_id = $_SESSION['id']; // This should be dynamic based on logged-in artist or user
$query = 'SELECT * FROM artworks WHERE artist_id = '.$artist_id.' ORDER BY created_at DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Projects</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Title</th>
    <th align="center">Description</th>
    <th align="center">Date</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="<?php echo $record['image_url']; ?>" width="100" height="100" alt="Artwork Image">
      </td>
      <td align="center"><?php echo $record['artwork_id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['title'] ); ?>
        <small><?php echo htmlentities( $record['description'] ); ?></small>
      </td>
      <td align="center"><?php echo htmlentities( $record['description'] ); ?></td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities( $record['created_at'] ); ?></td>
      <td align="center"><a href="projects_photo.php?id=<?php echo $record['artwork_id']; ?>">Photo</a></td>
      <td align="center"><a href="projects_edit.php?id=<?php echo $record['artwork_id']; ?>">Edit</a></td>
      <td align="center">
        <a href="projects.php?delete=<?php echo $record['artwork_id']; ?>" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="projects_add.php"><i class="fas fa-plus-square"></i> Add Project</a></p>

<?php
include( 'includes/footer.php' );
?>
