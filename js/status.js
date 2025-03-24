document.addEventListener("DOMContentLoaded", function () {
    const statusLabels = {
        Accepted: "Acceptée",
        Pending: "En Attente",
        Rejected: "Refusée"
    };

    const statusColors = {
        Accepted: "accepted",
        Pending: "pending",
        Rejected: "rejected"
    };

    // Restaurer les statuts depuis localStorage
    document.querySelectorAll("td.status").forEach(cell => {
        const offerId = cell.dataset.id;
        const savedStatus = localStorage.getItem("status_" + offerId);

        if (savedStatus && statusLabels[savedStatus]) {
            cell.textContent = statusLabels[savedStatus];
            cell.className = `status ${statusColors[savedStatus]}`;
        }
    });

    // Gérer le clic
    document.querySelectorAll("td.status").forEach(cell => {
        cell.addEventListener("click", function (e) {
            document.querySelectorAll(".status-options").forEach(el => el.remove());

            const offerId = cell.dataset.id;

            const optionsBox = document.createElement("div");
            optionsBox.classList.add("status-options");

            Object.keys(statusLabels).forEach(statusKey => {
                const button = document.createElement("button");
                button.textContent = statusLabels[statusKey];
                button.classList.add("status-btn", statusColors[statusKey]);

                button.addEventListener("click", () => {
                    cell.textContent = statusLabels[statusKey];
                    cell.className = `status ${statusColors[statusKey]}`;
                    localStorage.setItem("status_" + offerId, statusKey);
                    optionsBox.remove();
                });

                optionsBox.appendChild(button);
            });

            cell.style.position = "relative";
            cell.appendChild(optionsBox);
            e.stopPropagation();
        });
    });

    // Fermer les menus si on clique ailleurs
    document.addEventListener("click", () => {
        document.querySelectorAll(".status-options").forEach(el => el.remove());
    });
});
