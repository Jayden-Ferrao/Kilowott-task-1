// EventListener for 'learn more' btn
$(document).ready(function() {
    $('#learnMoreBtn').on('click', function(event) {
        event.preventDefault();
        alert('Thank you for your interest! More information will be available soon.');
    });
});

// EventListener for 'Contact form send message' btn
// $('#contactForm').on('submit', function(event) {
//     event.preventDefault();
//     let name = $('#name').val();
//     alert(`Message sent successfully by ${name}!`);
//     $('#contactForm')[0].reset();
// });

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

// Toggle dropdown menu on hover for Menu
$(document).ready(function() {
    // Toggle dropdown menu on hover for larger screens
    $('.nav-item.dropdown').hover(function() {
        if ($(window).width() >= 992) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(250);
            $(this).find('.caret').addClass('rotate');
        }
    }, function() {
        if ($(window).width() >= 992) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(100);
            $(this).find('.caret').removeClass('rotate');
        }
    });

    // Toggle dropdown menu on hover for dropdown-submenu on larger screens
    $('.dropdown-submenu').hover(function() {
        if ($(window).width() >= 992) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(250);
            $(this).find('.caret').addClass('rotate');
        }
    }, function() {
        if ($(window).width() >= 992) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(100);
            $(this).find('.caret').removeClass('rotate');
        }
    });

    // Prevent submenu from showing on page load
    $('.dropdown-submenu .dropdown-menu').hide();

    // Toggle dropdown menu on click for smaller screens
    $('.nav-item.dropdown > a').click(function(e) {
        if ($(window).width() < 992) {
            e.preventDefault();
            $(this).next('.dropdown-menu').stop(true, true).slideToggle(250);
            $(this).find('.caret').toggleClass('rotate'); // Rotates caret on click
        }
    });

    // Toggle submenu on click for smaller screens
    $('.dropdown-submenu > a').click(function(e) {
        if ($(window).width() < 992) {
            e.preventDefault();
            $(this).next('.dropdown-menu').stop(true, true).slideToggle(250);
            $(this).find('.caret').toggleClass('rotate'); // Rotates caret on click
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

// View details services popup
$(document).ready(function() {
    $('.service-item .btn-primary').on('click', function(e) {
      e.preventDefault();
      
      // Get the service information
      var card = $(this).closest('.card');
      var title = card.find('.card-title').text();
      var text = card.find('.card-text').text();
      var imageUrl = $(this).data('image'); 
      
      // Set the modal content
      $('#serviceModalLabel').text(title);
      $('#serviceImage').attr('src', imageUrl);
      $('#serviceInfo').text(text);
      
      // Show the modal
      $('#serviceModal').modal('show');
    });
  });
// JQuery: fadein-fadeout, slide, stop, callback, chaining, get-set-remove-add, ancestors-traversing-siblings
// JS: hoisting, strict, methods, get-set, call-apply-bind, async-await, DOM-BOM, slideup-slidedown-slidetoggle