// EventListener for 'learn more' btn
$(document).ready(function() {
    $('#learnMoreBtn').on('click', function(event) {
        event.preventDefault();
        alert('Thank you for your interest! More information will be available soon.');
    });
});

// EventListener for 'Contact form send message' btn
$('#contactForm').on('submit', function(event) {
    event.preventDefault();
    let name = $('#name').val();
    alert(`Message sent successfully by ${name}!`);
    $('#contactForm')[0].reset();
});

// Load More btn
$(document).ready(function() {
    var initialItems = 3;
    var loadMoreItems = 3;
    
    $('#services-list .service-item').slice(initialItems).hide();

    $('#loadMoreBtn').click(function() {
        $('#services-list .service-item:hidden').slice(0, loadMoreItems).slideDown();
        // Check if there are any hidden items left & Hides the button if no more items to show
        if ($('#services-list .service-item:hidden').length === 0) {
            $('#loadMoreBtn').fadeOut('slow'); 
        }
    });
});

// Toggle dropdown menu on hover for home
$(document).ready(function() {
    // Toggle dropdown menu on hover for main nav item
    $('.nav-item.dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(250);
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(100);
    });

    // Toggle dropdown menu on hover for dropdown-submenu
    $('.dropdown-submenu').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(250);
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(100);
    });

    // Prevent submenu from showing on page load
    $('.dropdown-submenu .dropdown-menu').hide();

    // Allow navigation when clicking "Home"
    $('.nav-item.dropdown > a').on('click', function(e) {
        var $this = $(this);
        if ($this.next('.dropdown-menu').is(':visible')) {
            // Let the default action occur
            window.location.href = $this.attr('href');
        } else {
            // Show the dropdown menu
            e.preventDefault();
            $this.next('.dropdown-menu').slideDown(250);
        }
    });
});

// Hide spinner and show thank you page
$(document).ready(function() {
    setTimeout(function() {
        $('.spinner-container').css('opacity', '0');
        $('#thank-you').css('opacity', '1');
        
        setTimeout(function() {
            $('.spinner-container').remove();
        }, 500);
    }, 2000);
});
// JQuery: fadein, fadeout, slide, stop, callback, chaining, get-set-remove-add, ancestors-traversing-siblings
// JS: hoisting, strict, methods, get-set, call-apply-bind, async-await, DOM-BOM, slideup-slidedown