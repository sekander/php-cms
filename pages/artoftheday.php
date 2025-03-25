<?php include( '../includes/header.php' ); ?>

<?php
$query = "
    SELECT 
        artworks.artwork_id,
        artworks.title AS artwork_title,
        artworks.description,
        artworks.image_url,
        artists.preferred_display_name AS artist_name
    FROM national_gallery.artworks AS artworks
    LEFT JOIN national_gallery.artists AS artists 
        ON artworks.artist_id = artists.artist_id
    ORDER BY RAND()
    LIMIT 1
";

$result = mysqli_query($connect, $query);
$artwork = mysqli_fetch_assoc($result);
?>

<main class="container py-5 mt-5 content-section">
    <h1 class="mb-4 text-center">🎨 Art of the Day</h1>

    <?php if ($artwork): ?>
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <?php if (!empty($artwork['image_url'])): ?>
                    <img src="<?= htmlspecialchars($artwork['image_url']) ?>" alt="<?= htmlspecialchars($artwork['artwork_title']) ?>" class="img-fluid rounded shadow">
                <?php else: ?>
                    <div class="bg-light text-muted text-center p-5 rounded">No image available</div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h2><?= htmlspecialchars($artwork['artwork_title']) ?></h2>
                <p class="text-muted">By <?= htmlspecialchars($artwork['artist_name'] ?? 'Unknown Artist') ?></p>
                <?php if (!empty($artwork['description'])): ?>
                    <p><?= nl2br(htmlspecialchars($artwork['description'])) ?></p>
                <?php else: ?>
                    <p class="text-muted">No description available for this piece.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No artwork found in the database.</div>
    <?php endif; ?>
</main>

<?php include( '../includes/footer.php' ); ?>