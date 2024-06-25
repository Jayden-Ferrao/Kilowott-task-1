// Function to check if an element is in viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}
// Function to handle scroll event
function handleScroll() {
    const contactSection = document.getElementById('contact');
    if (isInViewport(contactSection)) {
        contactSection.classList.add('slide-up');
        window.removeEventListener('scroll', handleScroll);
    }
}
window.addEventListener('scroll', handleScroll);

 // Check if sign in is active
$(document).ready(function() {
    var hash = window.location.hash;
    if (hash && hash === '#signin') {
        $('#signin-link').addClass('active');
    }
});

// JavaScript to handle active class for navbar items
$(document).ready(function() {
    $('.navbar-nav .nav-link').on('click', function() {
    $('.navbar-nav .nav-link').removeClass('active');
    $(this).addClass('active');
    });
 });