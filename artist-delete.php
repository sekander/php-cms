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

if(!isset($_GET['id'])) {
    header('Location: artist-dashboard.php');
    die();
  }

  $query = 'SELECT artwork_id 
  FROM artworks 
  WHERE artwork_id = '.$_GET['id'].' 
  AND artist_id = '.$_SESSION['id'].'
  LIMIT 1';
  $result = mysqli_query($connect, $query);

  if(mysqli_num_rows($result)) {
    // Delete any media records related to this artwork first
    $query = 'DELETE FROM artwork_media 
      WHERE artwork_id = '.$_GET['id'];
    mysqli_query($connect, $query);

    // Now delete the artwork
    $query = 'DELETE FROM artworks 
    WHERE artwork_id = '.$_GET['id'].' 
    AND artist_id = '.$_SESSION['id'].'
    LIMIT 1';
    mysqli_query($connect, $query);
}

header('Location: artist-dashboard.php');
die();