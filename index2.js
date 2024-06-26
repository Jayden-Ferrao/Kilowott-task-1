// Function to handle scroll event
function handleScroll() {
    const contactSection = document.getElementById('contact');
    if (isInViewport(contactSection)) {
        contactSection.classList.add('slide-up');
        window.removeEventListener('scroll', handleScroll);
    }
}
window.addEventListener('scroll', handleScroll);

