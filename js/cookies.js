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

    // Validation + envoi AJAX du formulaire cookies
    const cookieForm = document.querySelector(".cookie-box form");
    if (cookieForm) {
        cookieForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche l'envoi classique

            const selectedCookie = document.querySelector("input[name='cookie-choice']:checked");

            if (!selectedCookie) {
                showNotification("Veuillez sélectionner une option pour les cookies avant de valider.", "error", cookieForm);
                return;
            }

            const value = selectedCookie.value;

            fetch("cookies.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "cookies=" + encodeURIComponent(value)
            })
            .then(() => {
                // Optionnel : message de confirmation avant reload
                showNotification("Préférence enregistrée. Merci !", "success", cookieForm);

                setTimeout(() => {
                    location.reload(); // Recharge après la notif
                }, 1000);
            })
            .catch(() => {
                showNotification("Une erreur est survenue. Veuillez réessayer.", "error", cookieForm);
            });
        });
    }
});
