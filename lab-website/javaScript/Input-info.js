document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");
    const dobInput = document.getElementById("dob");
    const saveButton = document.querySelector('.save-button');

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent form from submitting by default
        let valid = true; // Flag to check if form is valid

        // Email Validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            alert("Please enter a valid email address.");
            emailInput.focus();
            valid = false;
        }

        // Phone Validation
        const phonePattern = /^\d{9,10}$/; // Adjust the pattern based on desired phone format
        if (!phonePattern.test(phoneInput.value)) {
            alert("Please enter a valid phone number with 9 to 10 digits.");
            phoneInput.focus();
            valid = false;
        }

        // Date of Birth Validation
        if (!dobInput.value) {
            alert("Please enter your date of birth.");
            dobInput.focus();
            valid = false;
        }

        // Submit form if all fields are valid
        if (valid) {
            form.submit();
            window.location.href = "Profile.html";
        }
    });

    // Redirect to "Input-info.html" when Save button is clicked (assuming it's a different action)
    // saveButton.addEventListener('click', function() {
    //     // Here you might want to save form data or handle it differently
    //     // You can also add a confirmation before redirection if needed
    //     window.location.href = "Input-info.html";
    // });
});