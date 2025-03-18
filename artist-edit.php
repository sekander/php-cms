<?php
session_start();
include('./admin/includes/database.php');
include('./admin/includes/config.php');
include('./admin/includes/functions.php');

if(!isset($_SESSION['id'])) {
  header('Location: ./admin/index.php');
  die();
}

$query = 'SELECT * FROM users WHERE id = '.$_SESSION['id'].' AND role = "artist" LIMIT 1';
$result = mysqli_query($connect, $query);

if(!mysqli_num_rows($result)) {
  header('Location: ./admin/dashboard.php');
  die();
}

// Check if artwork ID was provided
if(!isset($_GET['id'])) {
  header('Location: artist-dashboard.php');
  die();
}

// Get the artwork and verify ownership
$query = 'SELECT * 
  FROM artworks 
  WHERE artwork_id = '.$_GET['id'].' 
  AND artist_id = '.$_SESSION['id'].'
  LIMIT 1';
$result = mysqli_query($connect, $query);

if(!mysqli_num_rows($result)) {
  header('Location: artist-dashboard.php');
  die();
}

$record = mysqli_fetch_assoc($result);

// Handle form submission
if(isset($_POST['title'])) {
  
    if($_POST['title']) {
      
      $query = 'UPDATE artworks SET
        title = "'.mysqli_real_escape_string($connect, $_POST['title']).'",
        description = "'.mysqli_real_escape_string($connect, $_POST['description']).'",
        image_url = "'.mysqli_real_escape_string($connect, $_POST['image_url']).'"
        WHERE artwork_id = '.$_GET['id'].'
        AND artist_id = '.$_SESSION['id'].'
        LIMIT 1';
      mysqli_query($connect, $query);
      header('Location: artist-dashboard.php');
      die();
    } else {
      $error = "Please enter a title for your artwork";
    }
  }

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artwork</title>
    <link href="styles.css" type="text/css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
</head>
<body>
<h1>Edit Artwork</h1>
  
  <nav>
    <ul>
      <li><a href="artist-dashboard.php">My Artworks</a></li>
      <li><a href="artist-upload.php">Upload New Artwork</a></li>
      <li><a href="./admin/logout.php">Logout</a></li>
    </ul>
  </nav>
  
  <?php if(isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
  
  <form method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo htmlentities($record['title']); ?>">
    
    <br>
    
    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="5"><?php echo htmlentities($record['description']); ?></textarea>
    
    <script>
      ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
    </script>
    
    <br>
    
    <label for="image_url">Image URL:</label>
    <input type="text" name="image_url" id="image_url" value="<?php echo htmlentities($record['image_url']); ?>">
    <small>Enter a URL to your artwork image</small>
    
    <?php if($record['image_url']): ?>
      <div>
        <p>Current Image:</p>
        <img src="<?php echo $record['image_url']; ?>" width="200">
      </div>
    <?php endif; ?>
    
    <br>
    
    <input type="submit" value="Update Artwork">
  </form>
  
  <p><a href="artist-dashboard.php">Return to Dashboard</a></p>
</body>
</html>
