<?php include '../includes/header.php'; ?>

<!-- Collection Page Content -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4">Project Portfolio</h1>
                <p class="lead">Browse our collection of creative projects</p>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form action="collection.php" method="get" class="filter-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search projects..." 
                               value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <select name="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="Website" <?= (isset($_GET['type']) && $_GET['type'] == 'Website') ? 'selected' : '' ?>>Website</option>
                            <option value="Graphic Design" <?= (isset($_GET['type']) && $_GET['type'] == 'Graphic Design') ? 'selected' : '' ?>>Graphic Design</option>
                        </select>
                        <select name="sort" class="form-select">
                            <option value="newest" <?= (isset($_GET['sort']) && $_GET['sort'] == 'newest') ? 'selected' : '' ?>>Newest First</option>
                            <option value="oldest" <?= (isset($_GET['sort']) && $_GET['sort'] == 'oldest') ? 'selected' : '' ?>>Oldest First</option>
                            <option value="title_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'title_asc') ? 'selected' : '' ?>>Title (A-Z)</option>
                            <option value="title_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'title_desc') ? 'selected' : '' ?>>Title (Z-A)</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="collection.php" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="row">
            <?php
            // Build the base query
            $query = "SELECT * FROM projects WHERE 1=1";
            $params = [];

            // Apply search filter
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = mysqli_real_escape_string($connect, $_GET['search']);
                $query .= " AND (title LIKE '%$search%' OR content LIKE '%$search%')";
            }

            // Apply type filter
            if (isset($_GET['type']) && !empty($_GET['type'])) {
                $type = mysqli_real_escape_string($connect, $_GET['type']);
                $query .= " AND type = '$type'";
            }

            // Apply sorting
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
            switch ($sort) {
                case 'oldest':
                    $query .= " ORDER BY date ASC";
                    break;
                case 'title_asc':
                    $query .= " ORDER BY title ASC";
                    break;
                case 'title_desc':
                    $query .= " ORDER BY title DESC";
                    break;
                default: // newest
                    $query .= " ORDER BY date DESC";
                    break;
            }

            // Pagination
            $per_page = 9;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $per_page;
            $query .= " LIMIT $offset, $per_page";

            $result = mysqli_query($connect, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_assoc($result)) {
                    $title = htmlspecialchars($record['title']);
                    $content = strip_tags(substr($record['content'], 0, 100)) . '...';
                    $url = htmlspecialchars($record['url']);
                    $type = htmlspecialchars($record['type']);
                    $date = date('F Y', strtotime($record['date']));
                    $project_id = htmlspecialchars($record['id']);
                    
                    // Handle photo if it exists in the database
                    $image_url = 'https://via.placeholder.com/600x400?text=' . urlencode($title);
                    if (!empty($record['photo'])) {
                        $image_url = 'data:image/jpeg;base64,' . base64_encode($record['photo']);
                    }
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="project-card card h-100">
                            <div class="project-image-container">
                                <img src="<?= $image_url ?>" class="card-img-top" alt="<?= $title ?>" loading="lazy">
                                <div class="project-overlay">
                                    <span class="badge bg-primary"><?= $type ?></span>
                                    <?php if (!empty($url)): ?>
                                        <a href="<?= $url ?>" target="_blank" class="btn btn-light btn-sm mt-2">Visit Project</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $title ?></h5>
                                <p class="card-text text-muted"><?= $date ?></p>
                                <p class="card-text"><?= $content ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-12 text-center py-5">
                    <div class="alert alert-warning">No projects found matching your criteria.</div>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Project pagination">
                    <ul class="pagination justify-content-center">
                        <?php
                        // Count total projects for pagination
                        $count_query = "SELECT COUNT(*) as total FROM projects WHERE 1=1";
                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $count_query .= " AND (title LIKE '%$search%' OR content LIKE '%$search%')";
                        }
                        if (isset($_GET['type']) && !empty($_GET['type'])) {
                            $count_query .= " AND type = '$type'";
                        }
                        
                        $count_result = mysqli_query($connect, $count_query);
                        $total_projects = mysqli_fetch_assoc($count_result)['total'];
                        $total_pages = ceil($total_projects / $per_page);

                        // Previous button
                        if ($page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?'.http_build_query(array_merge($_GET, ['page' => $page - 1])).'">Previous</a></li>';
                        }

                        // Page numbers
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = $i == $page ? 'active' : '';
                            echo '<li class="page-item '.$active.'"><a class="page-link" href="?'.http_build_query(array_merge($_GET, ['page' => $i])).'">'.$i.'</a></li>';
                        }

                        // Next button
                        if ($page < $total_pages) {
                            echo '<li class="page-item"><a class="page-link" href="?'.http_build_query(array_merge($_GET, ['page' => $page + 1])).'">Next</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>