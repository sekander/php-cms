<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include('../admin/includes/database.php');
include('../admin/includes/config.php');
include('../admin/includes/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page Title -->
    <title>Art Explorer CMS</title>
    
    <!-- Meta Tags -->
    <meta name="keywords" content="art, gallery, museum, paintings, artists">
    <meta name="description" content="Discover thousands of artworks from renowned artists around the world">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- Main CSS File -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator" style="width: 0%"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">Art Explorer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/artoftheday.php">Art of the Day</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/collection.php">Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/artist.php">Artists</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-dark" href="../admin/index.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>