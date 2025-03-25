// Recherche d'offres
document.querySelector(".search-form").addEventListener("submit", function (e) {
    e.preventDefault();

    // Supprimer les notifications d'information existantes
    document.querySelectorAll(".notification.info").forEach(notification => notification.remove());

    // Afficher la notification de recherche en cours
    const searchingNotification = document.createElement("div");
    searchingNotification.className = "notification info";
    searchingNotification.textContent = "🔍 Recherche d'offres en cours...";
    document.body.appendChild(searchingNotification);

    // Récupérer le mot-clé en minuscules
    const searchTerm = document.getElementById("motcle").value.trim().toLowerCase();

    // Récupérer toutes les offres
    const offers = document.querySelectorAll(".offer-card");
    let foundCount = 0;

    // Filtrer les offres selon le mot-clé
    offers.forEach(offer => {
        const offerText = offer.textContent.toLowerCase();
        if (offerText.includes(searchTerm)) {
            offer.style.display = ""; // Afficher
            foundCount++;
        } else {
            offer.style.display = "none"; // Masquer
        }
    });

    // Après un délai, afficher le résultat de la recherche
    setTimeout(() => {
        searchingNotification.remove();

        const resultNotification = document.createElement("div");
        resultNotification.className = "notification info";
        resultNotification.textContent = foundCount === 0
            ? "Aucune offre ne correspond à la recherche."
            : foundCount + " offre(s) correspond(ent) à la recherche.";
        document.body.appendChild(resultNotification);

        setTimeout(() => {
            resultNotification.remove();
        }, 3000);
    }, 1500);
});

// Réinitialisation de la recherche : afficher toutes les offres
document.querySelector(".search-form").addEventListener("reset", function () {
    // Réafficher toutes les offres
    const offers = document.querySelectorAll(".offer-card");
    offers.forEach(offer => {
        offer.style.display = "";
    });
    // Supprimer d'éventuelles notifications
    document.querySelectorAll(".notification.info").forEach(notification => notification.remove());
});
