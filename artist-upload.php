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

if(isset($_POST['title'])) {
  
    if($_POST['title']) {
      
      $query = 'INSERT INTO artworks (
          artist_id,
          title,
          description,
          image_url,
          created_at
        ) VALUES (
          '.$_SESSION['id'].',
          "'.mysqli_real_escape_string($connect, $_POST['title']).'",
          "'.mysqli_real_escape_string($connect, $_POST['description']).'",
          "'.mysqli_real_escape_string($connect, $_POST['image_url']).'",
          NOW()
        )';
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
    <title>Upload Artwork</title>
    <link href="styles.css" type="text/css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  </head>
  <body>
        <h1>Upload New Artwork</h1>
        
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
            <input type="text" name="title" id="title" value="<?php echo isset($_POST['title']) ? htmlentities($_POST['title']) : ''; ?>">
            
            <br>
            
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="5"><?php echo isset($_POST['description']) ? htmlentities($_POST['description']) : ''; ?></textarea>
            
            <script>
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });
            </script>
            
            <br>
            
            <label for="image_url">Image URL:</label>
            <input type="text" name="image_url" id="image_url" value="<?php echo isset($_POST['image_url']) ? htmlentities($_POST['image_url']) : ''; ?>">
            <small>Enter a URL to your artwork image</small>
            
            <br>
            
            <input type="submit" value="Upload Artwork">
        </form>
        
        <p><a href="artist-dashboard.php">Return to Dashboard</a></p>
  </body>
  </html>