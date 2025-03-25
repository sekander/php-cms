<?php include( '../includes/header.php' ); ?>

<?php
// Query all artists ordered alphabetically
$query = "SELECT artist_id, preferred_display_name FROM national_gallery.artists ORDER BY preferred_display_name ASC";
$result = mysqli_query($connect, $query);

$grouped_artists = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($artist = mysqli_fetch_assoc($result)) {
        $name = $artist['preferred_display_name'];
        $first_letter = strtoupper(substr($name, 0, 1));

        if (!ctype_alpha($first_letter)) {
            $first_letter = '#';
        }

        $grouped_artists[$first_letter][] = [
            'id' => $artist['artist_id'],
            'name' => $name
        ];
    }
}

// Get all used letters for active links
$active_letters = array_keys($grouped_artists);
?>

<main class="container py-5 mt-5 content-section">
    <h1 class="mb-4">Artists A–Z</h1>

    <!-- Alphabet Filter -->
    <div class="mb-4 text-center">
        <?php foreach (range('A', 'Z') as $letter): ?>
            <?php if (in_array($letter, $active_letters)): ?>
                <a href="#<?= $letter ?>" class="btn btn-outline-primary btn-sm m-1"><?= $letter ?></a>
            <?php else: ?>
                <span class="btn btn-outline-secondary btn-sm m-1 disabled"><?= $letter ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if (in_array('#', $active_letters)): ?>
            <a href="#other" class="btn btn-outline-primary btn-sm m-1">#</a>
        <?php else: ?>
            <span class="btn btn-outline-secondary btn-sm m-1 disabled">#</span>
        <?php endif; ?>
    </div>

    <!-- Grouped Artist List -->
    <?php foreach ($grouped_artists as $letter => $artists): ?>
        <h4 id="<?= $letter === '#' ? 'other' : $letter ?>" class="mt-5"><?= htmlspecialchars($letter) ?></h4>
        <ul class="list-unstyled">
            <?php foreach ($artists as $artist): ?>
                <li>
                    <a href="artist.php?id=<?= $artist['id'] ?>">
                        <?= htmlspecialchars($artist['name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</main>


<?php include( '../includes/footer.php' ); ?>