document.addEventListener("DOMContentLoaded", function () {

    // Fonction pour afficher une notification stylisée près du champ concerné
    function showNotification(message, type, element = null) {
        const notification = document.createElement("div");
        notification.className = `notification ${type}`;
        notification.innerText = message;

        if (element) {
            element.parentNode.insertBefore(notification, element.nextSibling);
        } else {
            document.body.appendChild(notification);
        }

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Vérification des champs du formulaire d'inscription
    const inscriptionForm = document.querySelector("form[action='#'][method='post']");
    if (inscriptionForm) {
        inscriptionForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêche l'envoi réel du formulaire

            const nom = document.getElementById("nom");
            const prenom = document.getElementById("prenom");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirm_password");

            let valid = true;

            // Vérification du nom
            if (!nom.value.trim()) {
                showNotification("Veuillez entrer votre nom.", "error", nom);
                valid = false;
            }

            // Vérification du prénom
            if (!prenom.value.trim()) {
                showNotification("Veuillez entrer votre prénom.", "error", prenom);
                valid = false;
            }

            // Vérification de l'email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                showNotification("Veuillez entrer une adresse email valide.", "error", email);
                valid = false;
            }

            // Vérification des mots de passe
            if (password.value !== confirmPassword.value) {
                showNotification("Les mots de passe ne correspondent pas.", "error", confirmPassword);
                valid = false;
            }

            // Si tout est bon, afficher un message de succès et réinitialiser le formulaire
            if (valid) {
                showNotification("Inscription réussie !", "success", inscriptionForm);

                setTimeout(() => {
                    inscriptionForm.reset(); // Réinitialise tous les champs
                }, 2000); // Délai de 2 secondes pour laisser la notif s'afficher
            }
        });
    }

    // Gestion du bouton "Réinitialiser" 
    const resetButton = document.querySelector(".reset-btn");
    if (resetButton && inscriptionForm) {
        resetButton.addEventListener("click", function () {
            inscriptionForm.reset();
        });
    }

});
