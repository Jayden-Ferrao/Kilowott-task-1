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

$(document).ready(function() {
    // Function to highlight the card
    function highlightCard(card, callback) {
        $(card).css('background-color', '#d4edda');
        callback();
    }

    // Flag to track if the plan has been selected
    var planSelected = false;

    // Click event for the "Choose Plan" buttons
    $('.btn-primary').one('click', function() { // .one() ensures the event happens only once
        if (!planSelected) {
            var card = $(this).closest('.card');
            var planName = $(card).find('.card-title').text();

            // Call the highlightCard function with a callback to show an alert
            highlightCard(card, function() {
                alert('You have selected the ' + planName);
                planSelected = true; // Set the flag to true after selection
            });
        }
    });
});

// JQuery: fadein, fadeout, slide, stop, callback, chaining, get-set-remove-add, ancestors-traversing-siblings
// JS: hoisting, strict, methods, get-set, call-apply-bind, async-await, DOM-BOM, slideup-slidedown