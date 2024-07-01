// EventListener for learn more btn
$(document).ready(function() {
    $('#learnMoreBtn').on('click', function(event) {
        event.preventDefault();
        alert('Thank you for your interest! More information will be available soon.');
    });
});

// EventListener for Contact form btn
$('#contactForm').on('submit', function(event) {
    event.preventDefault();
    alert('Message sent successfully!');
    $('#contactForm')[0].reset();
});