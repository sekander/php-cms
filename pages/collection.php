<?php include('../includes/header.php'); ?>

<?php
// Capture filters from URL
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'newest';
$artist_filter = $_GET['artist'] ?? '';
$media_filter = $_GET['media'] ?? '';
$page = $_GET['page'] ?? 1;
$per_page = 6;
$offset = ($page - 1) * $per_page;

// Build base query
$conditions = [];
if (!empty($search)) {
    $search_safe = mysqli_real_escape_string($connect, $search);
    $conditions[] = "(artworks.title LIKE '%$search_safe%' OR artists.preferred_display_name LIKE '%$search_safe%')";
}
if (!empty($artist_filter)) {
    $artist_safe = mysqli_real_escape_string($connect, $artist_filter);
    $conditions[] = "artists.artist_id = '$artist_safe'";
}
if (!empty($media_filter)) {
    $media_safe = mysqli_real_escape_string($connect, $media_filter);
    $conditions[] = "EXISTS (
        SELECT 1 FROM national_gallery.artwork_media 
        WHERE artwork_media.artwork_id = artworks.artwork_id 
        AND media_type = '$media_safe'
    )";
}

// Final SQL query
$where_sql = count($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';
$order_sql = $sort === 'az' ? 'ORDER BY artworks.title ASC' : 'ORDER BY artworks.created_at DESC';

$query = "
    SELECT 
        artworks.artwork_id,
        artworks.title AS artwork_title,
        artworks.image_url,
        artworks.description,
        artworks.created_at,
        artists.preferred_display_name AS artist_name
    FROM national_gallery.artworks AS artworks
    LEFT JOIN national_gallery.artists AS artists
        ON artworks.artist_id = artists.artist_id
    $where_sql
    $order_sql
    LIMIT $per_page OFFSET $offset
";

$result = mysqli_query($connect, $query);

// Get total for pagination
$count_query = "
    SELECT COUNT(*) as total
    FROM national_gallery.artworks AS artworks
    LEFT JOIN national_gallery.artists AS artists
        ON artworks.artist_id = artists.artist_id
    $where_sql
";
$count_result = mysqli_query($connect, $count_query);
$total_artworks = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_artworks / $per_page);

// Fetch artists and media types for filter dropdowns
$artists_list = mysqli_query($connect, "SELECT artist_id, preferred_display_name FROM national_gallery.artists ORDER BY preferred_display_name ASC");
$media_types = ['image', 'video', 'audio'];
?>

<main class="container py-5 mt-5 content-section">
    <h1 class="mb-4 text-center">Explore the Collection</h1>

    <!-- Filters & Search -->
    <form method="get" class="row g-3 align-items-end mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search artworks or artists..." value="<?= htmlspecialchars($search) ?>">
    </div>
    <div class="col-md-2">
        <label class="form-label">Sort by</label>
        <select name="sort" class="form-select">
            <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Newest</option>
            <option value="az" <?= $sort === 'az' ? 'selected' : '' ?>>A–Z</option>
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">Artist</label>
        <select name="artist" class="form-select">
            <option value="">All Artists</option>
            <?php mysqli_data_seek($artists_list, 0); ?>
            <?php while ($artist = mysqli_fetch_assoc($artists_list)): ?>
                <option value="<?= $artist['artist_id'] ?>" <?= $artist_filter == $artist['artist_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($artist['preferred_display_name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">Media Type</label>
        <select name="media" class="form-select">
            <option value="">All Types</option>
            <?php foreach ($media_types as $type): ?>
                <option value="<?= $type ?>" <?= $media_filter === $type ? 'selected' : '' ?>>
                    <?= ucfirst($type) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Apply</button>
        <a href="collection.php" class="btn btn-outline-secondary w-100">Clear</a>
    </div>
</form>


    <!-- Artworks Grid -->
    <div class="row g-4">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($art = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <?php if (!empty($art['image_url'])): ?>
                            <img src="<?= htmlspecialchars($art['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($art['artwork_title']) ?>">
                        <?php else: ?>
                            <div class="bg-light p-5 text-muted text-center">No image</div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($art['artwork_title']) ?></h5>
                            <p class="text-muted small"><?= htmlspecialchars($art['artist_name'] ?? 'Unknown') ?></p>
                            <a href="artwork.php?id=<?= $art['artwork_id'] ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="alert alert-info">No artworks match your filters.</div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
            <!-- Previous -->
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            $range = 2; // how many pages around the current page to show
            $ellipsis_shown = false;

            for ($i = 1; $i <= $total_pages; $i++) {
                if (
                    $i == 1 || $i == $total_pages || 
                    ($i >= $page - $range && $i <= $page + $range)
                ) {
                    $ellipsis_shown = false;
                    ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                    </li>
                <?php
                } elseif (!$ellipsis_shown) {
                    $ellipsis_shown = true;
                    ?>
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                <?php
                }
            }
            ?>

            <!-- Next -->
            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

</main>

<?php include('../includes/footer.php'); ?>
