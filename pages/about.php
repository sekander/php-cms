<?php include '../includes/header.php';?>

<div class="container py-5 about-page">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Art Explorer CMS</h1>
        <p class="lead">A PHP-based Content Management System inspired by the National Gallery of Art Open Access Dataset</p>
    </div>

    <div class="card shadow-lg mb-5">
        <div class="card-body p-4">
            <h2 class="card-title h4 mb-4"><i class="fas fa-info-circle me-2"></i>PROJECT OVERVIEW</h2>
            <p class="card-text">
                This CMS project was built for an academic assignment focused on PHP, MySQL, and content management systems. It features:
            </p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">A fully functional admin dashboard for managing content</li>
                <li class="list-group-item">A frontend website that dynamically pulls data from the CMS</li>
                <li class="list-group-item">Integration with a MySQL database</li>
                <li class="list-group-item">Custom design using Bootstrap, Font Awesome, and jQuery</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title h5"><i class="fas fa-desktop me-2"></i>Frontend Features</h3>
                    <ul class="fa-ul">
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Responsive layout with Bootstrap 5</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Featured artworks gallery</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Artist and period-based filtering</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Artwork detail pages</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Scroll animations and micro-interactions</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Newsletter signup form</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title h5"><i class="fas fa-lock me-2"></i>Backend (Admin) Features</h3>
                    <ul class="fa-ul">
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Login with password security</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Admin dashboard</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>CRUD operations for artworks and artists</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Image upload</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Relational data using foreign keys</li>
                        <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>Customized UI and branding</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h3 class="card-title h5"><i class="fas fa-code me-2"></i>TECHNOLOGIES USED</h3>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-primary">PHP</span>
                <span class="badge bg-secondary">MySQL</span>
                <span class="badge bg-info">HTML5</span>
                <span class="badge bg-warning text-dark">CSS3</span>
                <span class="badge bg-success">JavaScript</span>
                <span class="badge bg-purple">Bootstrap 5</span>
                <span class="badge bg-dark">jQuery</span>
                <span class="badge bg-danger">Font Awesome</span>
                <span class="badge bg-teal">Animate.css</span>
                <span class="badge bg-indigo">CKEditor</span>
                <span class="badge bg-orange">MAMP/XAMPP</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title h5"><i class="fas fa-folder-open me-2"></i>PROJECT STRUCTURE</h3>
                    <pre class="bg-light p-3 rounded"><code>/admin/                 - Admin dashboard and CRUD pages
/includes/              - Reusable components
/css/style.css          - Custom styles
/js/main.js             - Frontend JS
/pages/                 - Static content pages
index.php               - Homepage</code></pre>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title h5"><i class="fas fa-user-shield me-2"></i>ADMIN CREDENTIALS (Sample)</h3>
                    <p>Login: <code>http://localhost/PHP-CMS/admin/login.php</code></p>
                    <p>Username: <code>admin</code></p>
                    <p>Password: <code>admin123</code></p>
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Note:</strong> Replace with secure credentials before production use.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h3 class="card-title h5"><i class="fas fa-database me-2"></i>DATA INSPIRATION</h3>
            <p>Inspired by the National Gallery of Art's Open Access dataset:</p>
            <a href="https://github.com/NationalGalleryOfArt/opendata" target="_blank" class="btn btn-outline-primary">
                <i class="fas fa-external-link-alt me-2"></i>View Dataset
            </a>
            <p class="mt-3">Fields modeled include:</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Artwork title</li>
                <li class="list-group-item">Artist name</li>
                <li class="list-group-item">Year of creation</li>
                <li class="list-group-item">Medium, dimensions, image URL</li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h3 class="card-title h5"><i class="fas fa-tasks me-2"></i>ASSIGNMENT CHECKLIST</h3>
            <div class="list-group">
                <div class="list-group-item">
                    <input class="form-check-input me-2" type="checkbox" checked disabled>
                    <label class="form-check-label">Custom admin dashboard</label>
                </div>
                <div class="list-group-item">
                    <input class="form-check-input me-2" type="checkbox" checked disabled>
                    <label class="form-check-label">Artworks + Artists CRUD functionality</label>
                </div>
                <div class="list-group-item">
                    <input class="form-check-input me-2" type="checkbox" checked disabled>
                    <label class="form-check-label">Responsive frontend UI</label>
                </div>
                <div class="list-group-item">
                    <input class="form-check-input me-2" type="checkbox" checked disabled>
                    <label class="form-check-label">Dynamic content from database</label>
                </div>
                <div class="list-group-item">
                    <input class="form-check-input me-2" type="checkbox" checked disabled>
                    <label class="form-check-label">GitHub repository</label>
                </div>
                <div class="list-group-item">
                    <input class="form-check-input me-2" type="checkbox" checked disabled>
                    <label class="form-check-label">Hosted locally on MAMP</label>
                </div>
                <div class="list-group-item">
                    <input class="form-check-input me-2" type="checkbox" checked disabled>
                    <label class="form-check-label">Follows academic integrity guidelines</label>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title h5"><i class="fas fa-download me-2"></i>HOW TO INSTALL LOCALLY</h3>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">Clone the repo:
                    <pre class="mt-2"><code>git clone https://github.com/your-username/art-explorer-cms.git</code></pre>
                </li>
                <li class="list-group-item">Import <code>cms.sql</code> into MySQL</li>
                <li class="list-group-item">Update <code>/admin/includes/config.php</code> with your DB credentials</li>
                <li class="list-group-item">Run locally via MAMP/XAMPP and open <code>http://localhost/PHP-CMS/</code></li>
            </ol>
        </div>
    </div>
</div>

<style>
.about-page {
    max-width: 1200px;
}
.bg-purple {
    background-color: #6f42c1;
}
.bg-teal {
    background-color: #20c997;
}
.bg-indigo {
    background-color: #6610f2;
}
.bg-orange {
    background-color: #fd7e14;
}
.card {
    border: none;
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
</style>

<?php include '../includes/footer.php'; ?>