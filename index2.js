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
