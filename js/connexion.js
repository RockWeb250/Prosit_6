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

        // Supprimer la notification après un certain temps
        setTimeout(() => {
            notification.remove();
        }, type === "success" ? 4000 : 3000); // Succès reste plus longtemps
    }

    // Validation du formulaire de connexion (FAUSSE CONNEXION)
    const loginForm = document.querySelector(".form-container");
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            let valid = true;

            if (!valid) {
                event.preventDefault(); 
            }

            // Vérification du champ email
            const emailInput = document.getElementById("email");
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailInput.value.trim()) {
                showNotification("Veuillez entrer votre email.", "error", emailInput);
                valid = false;
            } else if (!emailPattern.test(emailInput.value)) {
                showNotification("Veuillez entrer un email valide.", "error", emailInput);
                valid = false;
            }

            // Vérification du champ mot de passe
            const passwordInput = document.getElementById("password");
            if (!passwordInput.value.trim()) {
                showNotification("Veuillez entrer votre mot de passe.", "error", passwordInput);
                valid = false;
            }

            // Si tout est bon, affiche la notif et réinitialise le formulaire
            if (valid) {
                showNotification("Connexion réussie !", "success", loginForm);
            }
        });
    }
});
