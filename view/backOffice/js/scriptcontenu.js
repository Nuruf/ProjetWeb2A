document.addEventListener("DOMContentLoaded", function() {
    // Select the form elements
    var nomContenuElement = document.getElementById("nomContenu");
    var descriptionContenuElement = document.getElementById("descriptionContenu");

    // Add keyup event listener for the Content Name field
    nomContenuElement.addEventListener("keyup", function() {
        var errorElement = document.getElementById("nomContenu_error");
        if (!errorElement) {
            errorElement = document.createElement("small");
            errorElement.id = "nomContenu_error";
            nomContenuElement.parentNode.appendChild(errorElement);
        }

        if (nomContenuElement.value.length < 3) {
            errorElement.textContent = "Le nom du contenu doit contenir au moins 3 caractères.";
            errorElement.style.color = "red";
        } else {
            errorElement.textContent = "Correct";
            errorElement.style.color = "green";
        }
    });

    // Add keyup event listener for the Content Description field
    descriptionContenuElement.addEventListener("keyup", function() {
        var errorElement = document.getElementById("descriptionContenu_error");
        if (!errorElement) {
            errorElement = document.createElement("small");
            errorElement.id = "descriptionContenu_error";
            descriptionContenuElement.parentNode.appendChild(errorElement);
        }

        if (descriptionContenuElement.value.length < 10) {
            errorElement.textContent = "La description doit contenir au moins 10 caractères.";
            errorElement.style.color = "red";
        } else {
            errorElement.textContent = "Correct";
            errorElement.style.color = "green";
        }
    });

    // Form submission validation
    document.querySelector("form").addEventListener("submit", function(event) {
        var isValid = true;

        // Validate Content Name
        if (nomContenuElement.value.length < 3) {
            isValid = false;
            alert("Veuillez vérifier le nom du contenu.");
        }

        // Validate Content Description
        if (descriptionContenuElement.value.length < 10) {
            isValid = false;
            alert("Veuillez vérifier la description du contenu.");
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });
});