
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php

include( './admin/includes/database.php' );
include( './admin/includes/config.php' );
include( './admin/includes/functions.php' );

?>
<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Website Admin</title>
  
  <link href="styles.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>
<body>

  <h1>Welcome to My Website!</h1>
  
  <?php if(isset($_SESSION['id'])): ?>
    <p><a href="admin/dashboard.php">Go to Artist Dashboard</a></p>
  <?php else: ?>
    <p><a href="admin/index.php">Artist Login</a></p>
  <?php endif; ?>


  <p>This is the website frontend!</p>

  <?php

   $query = 'SELECT *
     FROM artworks';
//  $query = 'SELECT *
//    FROM artworks LIMIT 5';
//  $query = 'SELECT *
//    FROM projects
//    ORDER BY date DESC';

  $result = mysqli_query( $connect, $query );

  ?>

  <p>There are <?php echo mysqli_num_rows($result); ?> projects in the database!</p>

  <hr>

  <?php while($record = mysqli_fetch_assoc($result)): ?>

    <div>

      <h2><?php echo $record['title']; ?></h2>
      <?php echo $record['description']; ?>

      <?php if($record['image_url']): ?>

        <p>The image can be inserted using a base64 image:</p>

        <img src="<?php echo $record['image_url']; ?>">

        <p>Or by streaming the image through the image.php file:</p>

        <!-- <img src="admin/image.php?type=project&id=<?php echo $record['artist_id']; ?>&width=100&height=100"> -->

      <?php else: ?>

        <p>This record does not have an image!</p>

      <?php endif; ?>

    </div>

    <hr>

  <?php endwhile; ?>

</body>
</html>

