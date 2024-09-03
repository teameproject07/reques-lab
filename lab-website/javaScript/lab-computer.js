// Function to show the selected section and hide others
function showSection(sectionId) {
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
        if (section.id === sectionId) {
            section.classList.add('active');
        }
    });
}

// Event listener for form submission (for demonstration)
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Your message has been sent!');
});
function goBack() {
    window.history.back();
}