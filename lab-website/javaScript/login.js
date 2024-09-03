document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === 'admin' && password === 'admin') {
        window.location.href = 'schedule-user.html';
    } else {
        alert('Invalid username or password.');
    }
});

document.querySelector('.create-account').addEventListener('click', function() {
    window.location.href = "signup.html";
});

// document.getElementById("forgot-password-form").addEventListener("submit", function(event) {
//     event.preventDefault();
//     // Assuming the email is correctly entered
//     window.location.href = ".html";  // Redirects to the "Enter Code" page
// });
