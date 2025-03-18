<?php
session_start();
include('./admin/includes/database.php');
include('./admin/includes/config.php');
include('./admin/includes/functions.php');

// Check if user is logged in
if(!isset($_SESSION['id'])) {
  header('Location: ./admin/index.php');
  die();
}

// Check if user is an artist
$query = 'SELECT * FROM users WHERE id = '.$_SESSION['id'].' AND role = "artist" LIMIT 1';
$result = mysqli_query($connect, $query);

if(!mysqli_num_rows($result)) {
  header('Location: ./admin/dashboard.php');
  die();
}

$user = mysqli_fetch_assoc($result);

// Get artist information from artists table
$query = 'SELECT * FROM artists WHERE artist_id = '.$_SESSION['id'].' LIMIT 1';
$result = mysqli_query($connect, $query);
$artist = mysqli_fetch_assoc($result);

// Get artworks by this artist
$query = 'SELECT * FROM artworks WHERE artist_id = '.$_SESSION['id'].' ORDER BY artwork_id DESC';
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>
        <h1>Artist Dashboard</h1>
        <h2>Welcome, <?php echo $user['username']; ?></h2>

        <nav>
            <ul>
            <li><a href="artist-dashboard.php">My Artworks</a></li>
            <li><a href="artist-upload.php">Upload New Artwork</a></li>
            <li><a href="./admin/logout.php">Logout</a></li>
            </ul>
        </nav>

        <h3>My Artworks</h3>

        <?php if(mysqli_num_rows($result) > 0): ?>
            <table>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
            <?php while($record = mysqli_fetch_assoc($result)): ?>
                <tr>
                <td>
                    <?php if($record['image_url']): ?>
                    <img src="<?php echo $record['image_url']; ?>" width="100">
                    <?php else: ?>
                    No Image
                    <?php endif; ?>
                </td>
                <td><?php echo htmlentities($record['title']); ?></td>
                <td><?php echo substr(strip_tags($record['description']), 0, 100); ?>...</td>
                <td><a href="artist-edit.php?id=<?php echo $record['artwork_id']; ?>">Edit</a></td>
                <td><a href="artist-delete.php?id=<?php echo $record['artwork_id']; ?>" onclick="return confirm('Are you sure you want to delete this artwork?');">Delete</a></td>
                </tr>
            <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>You haven't uploaded any artworks yet.</p>
        <?php endif; ?>

        <p><a href="artist-upload.php">Upload New Artwork</a></p>
        <p><a href="index.php">Return to Home</a></p>

</body>
</html>