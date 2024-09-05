// JavaScript for signup form validation and navigation

// document.getElementById("signupForm").addEventListener("submit", function(event) {
//     event.preventDefault(); // Prevent form submission for now
    
    

   

// document.querySelector(".back-button").addEventListener("click", function() {
//     window.location.href = "index.html";
    
// });

// Email validation function
// function validateEmail(email) {
//     const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     return re.test(String(email).toLowerCase());
// }
// // JavaScript for signup form validation and password confirmation

// document.getElementById("signupForm").addEventListener("submit", function(event) {
//     event.preventDefault(); // Prevent form submission for now
    
//     // Fetching values from form fields
//     let username = document.getElementById("username").value.trim();
//     let password = document.getElementById("password").value.trim();
//     let password2 = document.getElementById("password2").value.trim();

//     // Basic form validation
//     let firstname = document.getElementById("firstname").value.trim();
//     let lastname = document.getElementById("lastname").value.trim();
//     let email = document.getElementById("email").value.trim();

//     // Basic form validation
//     if (username === "" || password === "" || password2 === "" || firstname === "" || lastname === "" || email === "") {
//         alert("Please fill in all fields");
//     } else if (password !== password2) {
//         alert("Passwords do not match");
//     } else if (password.length < 8) {
//         alert("Password must be at least 8 characters long");
//     }else if (!validateEmail(email)) {
//         alert("Please enter a valid email address");
//     } else {
//         // Proceed to the next step or form submission
//         // alert("Form submitted successfully!");
//         // Here you could redirect to the next page or submit the form
//         window.location.href = "schedule-user.html";
//     }
    
// });


document.querySelector(".back-button").addEventListener("click", function() {
    window.location.href = "signup.html";
});
