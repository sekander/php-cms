<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['id'])) {
    header('Location: projects.php');
    die();
}

if (isset($_POST['title'])) {

    if ($_POST['title'] && $_POST['artist_id'] && $_POST['image_url']) {

        // Escape user inputs and update artwork in the database
        $query = 'UPDATE artworks SET
            artist_id = "' . mysqli_real_escape_string($connect, $_POST['artist_id']) . '",
            title = "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
            description = "' . mysqli_real_escape_string($connect, $_POST['description']) . '",
            image_url = "' . mysqli_real_escape_string($connect, $_POST['image_url']) . '"
            WHERE artwork_id = ' . $_GET['id'] . '
            LIMIT 1';

        mysqli_query($connect, $query);

        set_message('Artwork has been updated');
    }

    header('Location: projects.php');
    die();
}

if (isset($_GET['id'])) {

    // Fetch artwork details from the database
    $query = 'SELECT *
        FROM artworks
        WHERE artwork_id = ' . $_GET['id'] . '
        LIMIT 1';
    $result = mysqli_query($connect, $query);

    if (!mysqli_num_rows($result)) {
        header('Location: projects.php');
        die();
    }

    $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');

?>

<h2>Edit Artwork</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities($record['title']); ?>">
  
  <br>

  <label for="artist_id">Artist ID:</label>
  <input type="text" name="artist_id" id="artist_id" value="<?php echo htmlentities($record['artist_id']); ?>">
  
  <br>

  <label for="description">Description:</label>
  <textarea name="description" id="description" rows="5"><?php echo htmlentities($record['description']); ?></textarea>
  
  <br>

  <label for="image_url">Image URL:</label>
  <input type="text" name="image_url" id="image_url" value="<?php echo htmlentities($record['image_url']); ?>">
  
  <br>

  <input type="submit" value="Edit Artwork">
  
</form>

<p><a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Artwork List</a></p>

<?php

include('includes/footer.php');

?>
