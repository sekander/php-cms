<footer class="py-5 content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h3 class="text-white mb-4">Art Explorer</h3>
                    <p>Discover the world's art heritage through our comprehensive collection and educational resources.</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-4">Explore</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Gallery</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Collections</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Artists</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-4">Resources</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Tutorials</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">API</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Help Center</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <p class="text-white-50">Subscribe to get updates on new artworks and features.</p>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email">
                            <button class="btn btn-light" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0">&copy; 2025 Art Explorer CMS. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white-50"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item mx-2"><a href="#" class="text-white-50"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item me-2"><a href="#" class="text-white-50"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-white-50"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Document Ready Function
        $(document).ready(function() {
            // Preloader
            $(window).on('load', function() {
                $('.preloader').fadeOut('slow');
            });
            
            // Navbar scroll effect
            $(window).scroll(function() {
                // Scroll indicator
                let scrollPercent = ($(window).scrollTop() / ($(document).height() - $(window).height())) * 100;
                $('.scroll-indicator').css('width', scrollPercent + '%');
                
                // Navbar background change
                if ($(this).scrollTop() > 100) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
                
                // Content section animations
                $('.content-section').each(function() {
                    let sectionTop = $(this).offset().top;
                    let windowBottom = $(window).scrollTop() + $(window).height();
                    
                    if (sectionTop < windowBottom - 100) {
                        $(this).addClass('visible');
                    }
                });
            }).trigger('scroll');
            
            // Smooth scrolling for anchor links
            $('a[href*="#"]').on('click', function(e) {
                if ($(this).hasClass('no-scroll') || $(this).attr('href') === '#') {
                    return;
                }
                
                e.preventDefault();
                
                $('html, body').animate(
                    {
                        scrollTop: $($(this).attr('href')).offset().top - 70,
                    },
                    500,
                    'linear'
                );
            });
            
            // Mobile menu close on click
            $('.navbar-nav>li>a').on('click', function(){
                $('.navbar-collapse').collapse('hide');
            });
            
            // Navbar link hover effect
            $('.nav-link').hover(
                function() {
                    $(this).css('color', 'var(--primary-color)');
                },
                function() {
                    if ($('.navbar').hasClass('scrolled')) {
                        $(this).css('color', 'var(--dark-color)');
                    } else {
                        $(this).css('color', 'white');
                    }
                }
            );
        });
    </script>
</body>
</html>