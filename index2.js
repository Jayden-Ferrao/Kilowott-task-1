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

// JQuery: fadein, fadeout, slide, stop, callback, chaining, get-set-remove-add, ancestors-traversing-siblings
// JS: hoisting, strict, methods, get-set, call-apply-bind, async-await, DOM-BOM