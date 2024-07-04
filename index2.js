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

// Load More functionality
$(document).ready(function() {
    var initialItems = 3;
    var loadMoreItems = 3;
    
    // Hide items that exceed the initial count
    $('#services-list .service-item:gt(' + (initialItems - 1) + ')').hide();

    $('#loadMoreBtn').click(function() {
        $('#services-list .service-item:hidden').slice(0, loadMoreItems).slideDown();
        // If no more hidden items, hide the load more button
        if ($('#services-list .service-item:hidden').length === 0) {
            $('#loadMoreBtn').fadeOut('slow');
        }
    });
});
// JQuery: fadein, fadeout, slide, stop, callback, chaining, get-set-remove-add, ancestors-traversing-siblings
// JS: hoisting, strict, methods, get-set, call-apply-bind, async-await, DOM-BOM, slideup-slidedown