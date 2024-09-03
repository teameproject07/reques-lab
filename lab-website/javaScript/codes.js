
const correctCode = "123456";
let isCodeCorrect = false;
let timerInterval;

function startTimer() {
    const timerElement = document.getElementById("timer");
    let timeLeft = 60;

    timerInterval = setInterval(() => {
        timeLeft -= 1;
        timerElement.textContent = `${timeLeft} seconds remaining`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            showAlert("The code has expired. Please request a new code.");
            disableInputs();
        }
    }, 1000);
}

function disableInputs() {
    const inputs = document.querySelectorAll(".code-inputs input");
    inputs.forEach(input => input.disabled = true);
}

function moveToNextInput(event) {
    const input = event.target;
    const maxLength = input.getAttribute("maxlength");
    const currentLength = input.value.length;

    if (isNaN(input.value)) {
        showAlert("Please enter only numbers.");
        input.value = "";
    } else if (currentLength >= maxLength) {
        let nextInput = input.nextElementSibling;
        if (nextInput && nextInput.tagName === "INPUT") {
            nextInput.focus();
        }
    }
}

function validateCode() {
    const inputs = document.querySelectorAll(".code-inputs input");
    let code = "";
    let allFilled = true;

    inputs.forEach(input => {
        if (input.value === "") {
            allFilled = false;
        }
        code += input.value;
    });

    if (!allFilled) {
        showAlert("Please enter the complete code.");
    } else if (code === correctCode) {
        isCodeCorrect = true;
        showAlert("The code is correct!");
    } else {
        isCodeCorrect = false;
        showAlert("The code is incorrect.");
    }
}

function showAlert(message) {
    const alertBox = document.getElementById("alert-box");
    const overlay = document.getElementById("overlay");
    const alertMessage = document.getElementById("alert-message");

    alertMessage.textContent = message;
    alertBox.style.display = "block";
    overlay.style.display = "block";
}

function closeAlert() {
    const alertBox = document.getElementById("alert-box");
    const overlay = document.getElementById("overlay");

    alertBox.style.display = "none";
    overlay.style.display = "none";

    // Clear all input fields
    const inputs = document.querySelectorAll(".code-inputs input");
    inputs.forEach(input => input.value = "");
    inputs[0].focus(); // Focus on the first input

    if (isCodeCorrect) {
        window.location.href = "request-lab.html"; // Replace with your desired page URL.
    }
}

const inputs = document.querySelectorAll(".code-inputs input");
inputs.forEach(input => {
    input.addEventListener('input', moveToNextInput);
});

// Start the timer when the page loads
window.onload = startTimer;
