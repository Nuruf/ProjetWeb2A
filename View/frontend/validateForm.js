// Fonction pour valider le formulaire
function validateForm(event) {
    // Empêcher l'envoi par défaut
    event.preventDefault();

    // Récupérer les champs
    const userId = document.getElementById('user_id').value.trim();
    const description = document.getElementById('description').value.trim();

    // Vérifier l'ID utilisateur (doit être un nombre positif non vide)
    if (!userId || isNaN(userId) || parseInt(userId) <= 0) {
        alert("Veuillez entrer un ID utilisateur valide (un nombre positif).");
        return false;
    }

    // Vérifier la description (doit être remplie et dépasser un certain nombre de caractères)
    if (!description || description.length < 10) {
        alert("La description doit contenir au moins 10 caractères.");
        return false;
    }

    // Si tout est correct, soumettre le formulaire
    document.getElementById('reclamationForm').submit();
}


