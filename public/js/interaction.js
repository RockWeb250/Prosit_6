document.addEventListener("DOMContentLoaded", function () {

    // Fonction pour afficher une notification stylisée près du champ concerné
    function showNotification(message, type, element) {
        const notification = document.createElement("div");
        notification.className = `notification ${type}`;
        notification.innerText = message;

        // Insérer la notification après l'élément concerné
        element.parentNode.insertBefore(notification, element.nextSibling);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }


    // Validation du champ "Courriel"
    const emailInput = document.getElementById("email");
    if (emailInput) {
        emailInput.addEventListener("blur", function () {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.value)) {
                showNotification("Veuillez entrer une adresse email valide.", "error", emailInput);
            }
        });
    }

    // Menu burger déroulant vertical 
    const menuContainer = document.createElement("div");
    menuContainer.className = "burger-menu";
    menuContainer.style.display = "none";
    menuContainer.style.position = "fixed";
    menuContainer.style.top = "50px";
    menuContainer.style.left = "10px";
    menuContainer.style.background = "white";
    menuContainer.style.padding = "10px";
    menuContainer.style.boxShadow = "0px 4px 6px rgba(0,0,0,0.1)";
    menuContainer.style.borderRadius = "5px";
    menuContainer.style.display = "flex";
    menuContainer.style.flexDirection = "column";
    menuContainer.style.gap = "10px";
    menuContainer.style.visibility = "hidden";
    menuContainer.innerHTML = document.querySelector(".navbar") ? document.querySelector(".navbar").innerHTML : '';
    document.body.appendChild(menuContainer);

    const menuButton = document.createElement("button");
    menuButton.innerText = "☰ Menu";
    menuButton.style.position = "fixed";
    menuButton.style.top = "10px";
    menuButton.style.left = "10px";
    menuButton.style.background = "black";
    menuButton.style.color = "white";
    menuButton.style.border = "none";
    menuButton.style.borderRadius = "5px";
    menuButton.style.padding = "10px";
    menuButton.style.cursor = "pointer";
    document.body.insertBefore(menuButton, document.body.firstChild);

    menuButton.addEventListener("click", function () {
        menuContainer.style.visibility = menuContainer.style.visibility === "hidden" ? "visible" : "hidden";
    });

    // Bouton retour en haut de page 
    const backToTopButton = document.createElement("button");
    backToTopButton.innerText = "⬆ Haut de page";
    backToTopButton.style.position = "fixed";
    backToTopButton.style.bottom = "20px";
    backToTopButton.style.right = "20px";
    backToTopButton.style.padding = "10px";
    backToTopButton.style.background = "grey";
    backToTopButton.style.color = "white";
    backToTopButton.style.border = "none";
    backToTopButton.style.borderRadius = "5px";
    backToTopButton.style.cursor = "pointer";
    backToTopButton.style.display = "none";
    document.body.appendChild(backToTopButton);

    window.addEventListener("scroll", function () {
        backToTopButton.style.display = window.scrollY > 300 ? "block" : "none";
    });

    backToTopButton.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});