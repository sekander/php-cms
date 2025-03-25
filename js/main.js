$(document).ready(function () {
    // Preloader
    $(window).on("load", function () {
      $(".preloader").fadeOut("slow");
    });
  
    // Scroll & Animation Logic
    $(window)
      .scroll(function () {
        let scrollPercent =
          ($(window).scrollTop() /
            ($(document).height() - $(window).height())) *
          100;
        $(".scroll-indicator").css("width", scrollPercent + "%");
  
        // Navbar background
        if ($(this).scrollTop() > 100) {
          $(".navbar").addClass("scrolled");
        } else {
          $(".navbar").removeClass("scrolled");
        }
  
        // Content visibility animation
        $(".content-section").each(function () {
          let sectionTop = $(this).offset().top;
          let windowBottom = $(window).scrollTop() + $(window).height();
  
          if (sectionTop < windowBottom - 100) {
            $(this).addClass("visible");
          }
        });
      })
      .trigger("scroll");
  
    // Smooth scroll for anchor links
    $('a[href*="#"]').on("click", function (e) {
      if ($(this).hasClass("no-scroll") || $(this).attr("href") === "#") {
        return;
      }
      e.preventDefault();
      $("html, body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top - 70,
        },
        500,
        "linear"
      );
    });
  
    // Close mobile menu on click
    $(".navbar-nav>li>a").on("click", function () {
      $(".navbar-collapse").collapse("hide");
    });
  
    // Hover color effect on navbar links
    $(".nav-link").hover(
      function () {
        $(this).css("color", "var(--primary-color)");
      },
      function () {
        if ($(".navbar").hasClass("scrolled")) {
          $(this).css("color", "var(--dark-color)");
        } else {
          $(this).css("color", "white");
        }
      }
    );
  });
  