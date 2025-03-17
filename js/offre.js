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
        }, type === "success" ? 4000 : 3000); // Success reste un peu plus longtemps
    }

    // Gestion du fichier CV avec affichage et retrait du fichier sélectionné
    const cvInput = document.getElementById("cv");
    let removeCvButton, cvLabel;

    if (cvInput) {
        // Création d'un conteneur pour organiser les éléments
        const cvContainer = document.createElement("div");
        cvContainer.style.display = "flex";
        cvContainer.style.alignItems = "center";
        cvContainer.style.gap = "10px";

        // Récupérer le bouton d'upload
        const uploadButton = cvInput.parentNode;
        uploadButton.parentNode.insertBefore(cvContainer, uploadButton);
        cvContainer.appendChild(uploadButton);

        // Création d'un label pour afficher le fichier sélectionné
        cvLabel = document.createElement("p");
        cvLabel.id = "cv-label";
        cvLabel.style.fontSize = "12px";
        cvLabel.style.color = "gray";
        cvContainer.appendChild(cvLabel);

        // Bouton "Retirer CV"
        removeCvButton = document.createElement("button");
        removeCvButton.innerText = "Retirer CV";
        removeCvButton.style.display = "none";
        removeCvButton.style.background = "red";
        removeCvButton.style.color = "white";
        removeCvButton.style.border = "none";
        removeCvButton.style.padding = "5px 10px";
        removeCvButton.style.cursor = "pointer";
        cvContainer.appendChild(removeCvButton);

        // Gestion de l'ajout d'un fichier CV
        cvInput.addEventListener("change", function () {
            const allowedFormats = [".pdf", ".doc", ".docx", ".odt", ".rtf", ".jpg", ".png"];
            const file = cvInput.files[0];

            if (file) {
                const fileSizeMB = file.size / 1024 / 1024;
                const fileExtension = file.name.substring(file.name.lastIndexOf("."));
                if (!allowedFormats.includes(fileExtension)) {
                    showNotification("Format de fichier non autorisé.", "error", cvInput);
                    cvInput.value = "";
                    cvLabel.textContent = "";
                    removeCvButton.style.display = "none";
                } else if (fileSizeMB > 2) {
                    showNotification("Le fichier ne doit pas dépasser 2 Mo.", "error", cvInput);
                    cvInput.value = "";
                    cvLabel.textContent = "";
                    removeCvButton.style.display = "none";
                } else {
                    cvLabel.textContent = "Fichier sélectionné : " + file.name;
                    removeCvButton.style.display = "inline-block";
                }
            }
        });

        // Suppression du CV
        removeCvButton.addEventListener("click", function () {
            cvInput.value = "";
            cvLabel.textContent = "";
            removeCvButton.style.display = "none";
        });

        // Réinitialisation du formulaire (suppression du CV)
        const resetButton = document.querySelector(".reset-btn");
        if (resetButton) {
            resetButton.addEventListener("click", function () {
                cvInput.value = "";
                cvLabel.textContent = "";
                removeCvButton.style.display = "none";
            });
        }
    }

    // Vérification de la présence du CV et des champs obligatoires lors de la soumission du formulaire "offre"
    const offreForm = document.querySelector("form"); // Sélectionner le bon formulaire
    if (offreForm) {
        offreForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêcher la soumission réelle pour voir la notification
            let valid = true;

            // Vérifier si le CV est joint
            if (!cvInput.files.length) {
                showNotification("Veuillez joindre un CV.", "error", cvInput);
                valid = false;
            }

            // Vérifier si les champs obligatoires sont remplis
            const requiredFields = ["nom", "prenom", "email"];
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field || field.value.trim() === "") {
                    showNotification(`Veuillez remplir le champ ${fieldId}.`, "error", field);
                    valid = false;
                }
            });

            // Vérification du format de l'email
            const emailInput = document.getElementById("email");
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.value)) {
                showNotification("Veuillez entrer une adresse email valide.", "error", emailInput);
                valid = false;
            }

            // Affichage de la notification de succès et réinitialisation du formulaire si tout est valide
            if (valid) {
                showNotification("Candidature envoyée avec succès !", "success", offreForm);

                setTimeout(() => {
                    offreForm.reset();
                    if (cvInput) {
                        cvInput.value = "";
                        cvLabel.textContent = "";
                        removeCvButton.style.display = "none";
                    }
                }, 1000);
            }
        });
    }
});
