document.querySelector('.Submit').addEventListener('click', function() {
    const form = document.getElementById('admin-form');
    const password1 = document.getElementById('Password1').value;
    const password2 = document.getElementById('Password2').value;
    const email = document.getElementById('Email').value;

    // Check if passwords match
    if (password1 !== password2) {
        alert('Passwords do not match. Please try again.');
        return; // Prevent form submission
    }

    // Validate email format
    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return; // Prevent form submission
    }

    // If all validations pass, navigate to the next page
    window.location.href = "schedule-admin.html";
});

// Function to validate email format
function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailPattern.test(email);
}

// Toggle password visibility
document.querySelectorAll('.toggle-password').forEach(item => {
    item.addEventListener('click', function() {
        const input = document.querySelector(this.getAttribute('data-toggle'));
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        // Toggle icon class
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});