// document.getElementById('change-to-phone').addEventListener('click', function(e) {
//     e.preventDefault();
    
//     const emailInput = document.querySelector('input[type="email"]');
//     const link = document.getElementById('change-to-phone');
    
//     if (emailInput.type === "email") {
//         emailInput.type = "text";
//         emailInput.placeholder = "Phone Number";
//         link.textContent = "Change to Email";
//     } else {
//         emailInput.type = "email";
//         emailInput.placeholder = "Email";
//         link.textContent = "Change to Phone number";
//     }


//  });
 document.getElementById('forgot-password-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from actually submitting
    window.location.href = "codes.html"; // Show the modal
});

function goBack() {
    window.history.back();
}
