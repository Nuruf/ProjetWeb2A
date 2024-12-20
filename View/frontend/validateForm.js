// JavaScript File: validateform.js

// Validation Function
function validateForm(event) {
    // Prevent default form submission
    event.preventDefault();

    // Get the description value
    const description = document.getElementById('description').value.trim();

    // Validate the description (must be at least 10 characters)
    if (!description || description.length < 10) {
        alert("La description doit contenir au moins 10 caractères.");
        return false;
    }

    // If validation passes, submit the form
    document.getElementById('reclamationForm').submit();
}

// Add event listener to the form
document.getElementById('reclamationForm').addEventListener('submit', validateForm);
