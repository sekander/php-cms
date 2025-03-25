<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include('admin/includes/database.php');
include('admin/includes/config.php');
include('admin/includes/functions.php');
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
    <link rel="stylesheet" href="css/style.css">
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
            <a class="navbar-brand fw-bold" href="#">Art Explorer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="pages/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/artoftheday.php">Art of the Day</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/collection.php">Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/artist.php">Artists</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-dark" href="#">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">Art Explorer CMS</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Discover thousands of artworks, learn about renowned artists, and dive into the rich details of each piece — all in one place</p>
                    <a href="pages/collection.php" 
                    class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                    Explore Collection
                </a>
                </div>
                <div class="col-lg-5 d-none d-lg-block animate__animated animate__fadeIn animate__delay-1s">
                    <img src="https://media1.giphy.com/media/mPDjPLlff1gDEcji2E/200.webp?cid=82a1493b8sanspt5uu8mkxaqov6pn1o0hpoaipw35kre7jeh&ep=v1_stickers_trending&rid=200.webp&ct=s" alt="Artwork" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 my-5 content-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Discover the beauty and history of art</h2>
                    <p class="lead">Explore thousands of artworks, learn about renowned artists, and dive into the rich details of each piece—all in one place</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card card p-4 h-100">
                        <div class="text-center">
                            <i class="fas fa-palette feature-icon"></i>
                            <h4>Browse Art by Artist</h4>
                            <p>Search and view artworks by your favorite artists. From classic masters to modern innovators, explore their contributions to the art world.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card card p-4 h-100">
                        <div class="text-center">
                            <i class="fas fa-hourglass-half feature-icon"></i>
                            <h4>Explore Art by Period</h4>
                            <p>Travel through time and discover art from different eras, including the Renaissance, Baroque, Impressionism, and more.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card card p-4 h-100">
                        <div class="text-center">
                            <i class="fas fa-search feature-icon"></i>
                            <h4>Search by Keywords</h4>
                            <p>Looking for something specific? Use our search functionality to find artworks by title, medium, or theme.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card card p-4 h-100">
                        <div class="text-center">
                            <i class="fas fa-info-circle feature-icon"></i>
                            <h4>Artwork Details</h4>
                            <p>Dive deep into each piece with detailed information, including descriptions, dimensions, creation dates, and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artworks Gallery -->
    <section class="py-5 bg-light content-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Featured Artworks</h2>
                    <p class="lead">Explore our curated selection of masterpieces</p>
                </div>
            </div>
            
            <div class="row">
                <?php
                $query = 'SELECT * FROM artworks LIMIT 9';
                $result = mysqli_query($connect, $query);

                if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($record = mysqli_fetch_assoc($result)):
                        $image_url = htmlspecialchars($record['image_url']);
                        $title = htmlspecialchars($record['title']);
                        $artist = htmlspecialchars($record['artist'] ?? 'Unknown Artist');
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="artwork-card card">
                                <img src="<?= $image_url ?>" class="card-img-top" alt="<?= $title ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $title ?></h5>
                                    <p class="card-text text-muted"><?= $artist ?></p>
                                    <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-info">No artworks found in the database.</div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="#" class="btn btn-primary">View All Artworks</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white content-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="mb-3">Ready to explore more art?</h2>
                    <p class="lead mb-0">Join our community of art enthusiasts and get access to exclusive content.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="#" class="btn btn-light btn-lg">Sign Up Now</a>
                </div>
            </div>
        </div>
    </section>

<?php include('includes/footer.php'); ?>