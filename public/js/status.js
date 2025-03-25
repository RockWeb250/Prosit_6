document.addEventListener("DOMContentLoaded", function () {
    const statusLabels = {
        Accepted: "Acceptée",
        Pending: "En Attente",
        Rejected: "Refusée",
        Unsent : "Pas envoyée"
    };

    const statusClasses = {
        Accepted: "accepted",
        Pending: "pending",
        Rejected: "refused",
        Unsent : "unsent"
    };

    // 1. Appliquer les statuts sauvegardés ou afficher "Pas envoyée"
    document.querySelectorAll("td.status").forEach(cell => {
        const offerId = cell.dataset.id;
        const savedStatus = localStorage.getItem("status_" + offerId);

        if (savedStatus && statusLabels[savedStatus]) {
            cell.textContent = statusLabels[savedStatus];
            cell.className = `status ${statusClasses[savedStatus]}`;
        } else {
            cell.textContent = "Pas envoyée";
            cell.className = "unsent";
            cell.className = "status no-status";
        }
    });

    // 2. Gérer le clic sur une cellule (affiche les options)
    document.querySelectorAll("td.status").forEach(cell => {
        cell.addEventListener("click", function (e) {
            // Supprimer les autres menus
            document.querySelectorAll(".status-options").forEach(el => el.remove());

            const offerId = cell.dataset.id;

            const optionsBox = document.createElement("div");
            optionsBox.classList.add("status-options");

            Object.keys(statusLabels).forEach(statusKey => {
                const button = document.createElement("button");
                button.textContent = statusLabels[statusKey];
                button.classList.add("status-btn", statusClasses[statusKey]);

                button.addEventListener("click", (event) => {
                    event.stopPropagation();

                    cell.textContent = statusLabels[statusKey];
                    cell.className = `status ${statusClasses[statusKey]}`;
                    localStorage.setItem("status_" + offerId, statusKey);

                    setTimeout(() => {
                        document.querySelectorAll(".status-options").forEach(el => el.remove());
                    }, 10);
                });


                optionsBox.appendChild(button);
            });

            cell.appendChild(optionsBox);
            e.stopPropagation();
        });
    });

    // 3. Fermer les options si clic ailleurs
    document.addEventListener("click", () => {
        document.querySelectorAll(".status-options").forEach(el => el.remove());
    });
});
