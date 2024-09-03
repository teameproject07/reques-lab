// JavaScript for signup form validation and navigation

document.getElementById("signupForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission for now
    
    // Basic form validation
    let firstname = document.getElementById("firstname").value.trim();
    let lastname = document.getElementById("lastname").value.trim();
    let email = document.getElementById("email").value.trim();

    if (firstname === "" || lastname === "" || email === "") {
        alert("Please fill in all fields");
    } else if (!validateEmail(email)) {
        alert("Please enter a valid email address");
    } else {
        window.location.href = "signup-Pw-Em.html";
    }
});

document.querySelector(".back-button").addEventListener("click", function() {
    window.location.href = "index.html";
    
});

// Email validation function
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}
