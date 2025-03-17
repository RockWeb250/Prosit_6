document.addEventListener("DOMContentLoaded", function () {

    // 📌 Affichage des notifications
    function showNotification(message, type, element = null) {
        const notification = document.createElement("div");
        notification.className = `notification ${type}`;
        notification.innerText = message;

        if (element) {
            element.parentNode.insertBefore(notification, element.nextSibling);
        } else {
            document.body.appendChild(notification);
        }

        // Supprimer la notification après un délai
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // 🟢 Gestion du fichier joint
    let photoInput = document.getElementById("photo");
    if (photoInput) {
        const photoContainer = document.createElement("div");
        photoContainer.style.display = "flex";
        photoContainer.style.alignItems = "center";
        photoContainer.style.gap = "10px";

        photoInput.parentNode.insertBefore(photoContainer, photoInput);
        photoContainer.appendChild(photoInput);

        const removePhotoButton = document.createElement("button");
        removePhotoButton.innerText = "Retirer le fichier";
        removePhotoButton.style.display = "none";
        removePhotoButton.style.background = "red";
        removePhotoButton.style.color = "white";
        removePhotoButton.style.border = "none";
        removePhotoButton.style.padding = "5px 10px";
        removePhotoButton.style.cursor = "pointer";
        photoContainer.appendChild(removePhotoButton);

        // Afficher le bouton "Retirer le fichier" lorsque l'utilisateur sélectionne un fichier
        photoInput.addEventListener("change", function () {
            if (photoInput.files.length > 0) {
                removePhotoButton.style.display = "inline-block";
            }
        });

        // Supprimer le fichier et cacher le bouton
        removePhotoButton.addEventListener("click", function () {
            resetFileInput();
        });

        // Réinitialisation correcte du champ fichier
        function resetFileInput() {
            const newInput = document.createElement("input");
            newInput.type = "file";
            newInput.id = "photo";
            newInput.name = "photo";
            newInput.className = "form-input";

            photoInput.replaceWith(newInput);
            photoInput = newInput;
            removePhotoButton.style.display = "none";

            // Réattacher l'événement pour afficher le bouton "Retirer"
            photoInput.addEventListener("change", function () {
                if (photoInput.files.length > 0) {
                    removePhotoButton.style.display = "inline-block";
                }
            });
        }

        // Réinitialiser le fichier si le bouton reset est cliqué
        const resetButton = document.querySelector(".reset-btn");
        if (resetButton) {
            resetButton.addEventListener("click", function () {
                resetFileInput();
            });
        }
    }

    // 🟢 Validation du formulaire
    const avisForm = document.querySelector(".form-container");
    if (avisForm) {
        avisForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêcher l'envoi du formulaire
            let valid = true;

            const selectedCategory = document.querySelector("input[name='categories']:checked");
            if (!selectedCategory) {
                showNotification("Veuillez sélectionner au moins une catégorie.", "error", avisForm);
                valid = false;
            }

            if (photoInput && photoInput.files.length === 0) {
                showNotification("Veuillez joindre un fichier avant de soumettre.", "error", photoInput);
                valid = false;
            }

            const satisfactionInput = document.querySelector("input[name='satisfaction']:checked");
            if (!satisfactionInput) {
                showNotification("Veuillez indiquer votre niveau de satisfaction.", "error", avisForm);
                valid = false;
            }

            const commentaireInput = avisForm.querySelector("textarea[name='commentaires']");
            if (commentaireInput && commentaireInput.value.trim() === "") {
                showNotification("Veuillez entrer un commentaire.", "error", commentaireInput);
                valid = false;
            }

            // ✅ Tout est valide : Afficher la notification et réinitialiser
            if (valid) {
                showNotification("Avis envoyé avec succès !", "success", avisForm);

                setTimeout(() => {
                    avisForm.reset();
                    resetFileInput(); 
                }, 500);
            }
        });
    }
});
