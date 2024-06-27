// Functio to handle scroll event slideup
function handleScroll() {
    const aboutSection = document.getElementById('about');
    const contactSection = document.getElementById('contact');

    if (isInViewport(aboutSection)) {
        aboutSection.classList.add('slide-up');
    }

    if (isInViewport(contactSection)) {
        contactSection.classList.add('slide-up');
    }

    if (aboutSection.classList.contains('slide-up') && contactSection.classList.contains('slide-up')) {
        window.removeEventListener('scroll', handleScroll);
    }
}
window.addEventListener('scroll', handleScroll);

// EventListener for learn more btn
document.addEventListener('DOMContentLoaded', function() {
    var learnMoreBtn = document.getElementById('learnMoreBtn');
    learnMoreBtn.addEventListener('click', function(event) {
        event.preventDefault();
        alert('Thank you for your interest! More information will be available soon.');
    });
});

// Add event listener for Contactform submission
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Message sent successfully!');
    document.getElementById('contactForm').reset();
});