let selectedSessions = [];

// Function to open the custom alert modal and clear previous requests
function openCustomAlert() {
    resetForm(); // Clear the form and reset session selections
    document.getElementById("customAlert").style.display = "flex";
}

// Function to close the custom alert modal
function closeCustomAlert() {
    document.getElementById("customAlert").style.display = "none";
}

// Function to reset the form and clear session selections
function resetForm() {
    // Clear all input fields
    document.getElementById("date").value = "";
    document.getElementById("subject").value = "";
    document.getElementById("generation").value = "";
    document.getElementById("app").value = "";
    document.getElementById("numberStudent").value = "";
    
    // Clear selected sessions
    selectedSessions = [];
    document.querySelectorAll('.session-button').forEach(function(button) {
        button.classList.remove('selected'); // Remove the 'selected' class from all session buttons
    });
}

// Function to select/deselect a session
function selectSession(button) {
    const maxSessions = 3;
    const sessionNumber = button.textContent;

    if (selectedSessions.includes(sessionNumber)) {
        // Deselect the session
        selectedSessions = selectedSessions.filter(num => num !== sessionNumber);
        button.classList.remove('selected');
    } else if (selectedSessions.length < maxSessions) {
        // Select the session
        selectedSessions.push(sessionNumber);
        button.classList.add('selected');
    } else {
        Swal.fire('Maximum 3 sessions can be selected.');
    }
}

// Function to handle the submission of the alert form
function submitRequest() {
    const date = document.getElementById("date").value;
    const subject = document.getElementById("subject").value;
    const generation = document.getElementById("generation").value;
    const app = document.getElementById("app").value;
    const numberStudent = document.getElementById("numberStudent").value;
    
    // Validate form fields
    if (date && subject && generation && app && numberStudent && selectedSessions.length > 0) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Your request was successfully submitted",
            showConfirmButton: false,
            timer: 1500
        });
        closeCustomAlert();
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please fill in all fields and select at least one session."
        });
    }
}

// Attach click event to 'request-lab' boxes
document.querySelectorAll('.request-lab').forEach(function(card) {
    card.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link action
        openCustomAlert(); // Show the custom alert modal
    });
});
