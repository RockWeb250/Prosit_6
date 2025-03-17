document.addEventListener("DOMContentLoaded", function() {
    // Fonction pour afficher une notification stylisée près du formulaire des cookies
    function showNotification(message, type, element) {
        const notification = document.createElement("div");
        notification.className = `notification ${type}`;
        notification.innerText = message;

        element.parentNode.insertBefore(notification, element.nextSibling);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Validation des cookies avant soumission
    const cookieForm = document.querySelector(".cookie-box form");
    if (cookieForm) {
        cookieForm.addEventListener("submit", function(event) {
            const selectedCookie = document.querySelector("input[name='cookie-choice']:checked");

            if (!selectedCookie) {
                showNotification("Veuillez sélectionner une option pour les cookies avant de valider.", "error", cookieForm);
                event.preventDefault();
            }
        });
    }
});
