document.addEventListener("DOMContentLoaded", function() {
    // Select the form elements
    var nomCatElement = document.getElementById("nomCat");
    var descriptionCatElement = document.getElementById("descriptionCat");

    // Add keyup event listener for the Category Name field
    nomCatElement.addEventListener("keyup", function() {
        var errorElement = document.getElementById("nomCat_error");
        if (!errorElement) {
            errorElement = document.createElement("small");
            errorElement.id = "nomCat_error";
            nomCatElement.parentNode.appendChild(errorElement);
        }

        if (nomCatElement.value.length < 3) {
            errorElement.textContent = "Le nom de la catégorie doit contenir au moins 3 caractères.";
            errorElement.style.color = "red";
        } else {
            errorElement.textContent = "Correct";
            errorElement.style.color = "green";
        }
    });

    // Add keyup event listener for the Category Description field
    descriptionCatElement.addEventListener("keyup", function() {
        var errorElement = document.getElementById("descriptionCat_error");
        if (!errorElement) {
            errorElement = document.createElement("small");
            errorElement.id = "descriptionCat_error";
            descriptionCatElement.parentNode.appendChild(errorElement);
        }

        if (descriptionCatElement.value.length < 10) {
            errorElement.textContent = "La description doit contenir au moins 10 caractères.";
            errorElement.style.color = "red";
        } else {
            errorElement.textContent = "Correct";
            errorElement.style.color = "green";
        }
    });
});