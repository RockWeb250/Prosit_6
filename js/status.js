document.addEventListener("DOMContentLoaded", function () {
    const statusColors = {
        Accepted: "accepted",
        Pending: "pending",
        Rejected: "refused"
    };

    document.querySelectorAll("td.status").forEach(cell => {
        cell.addEventListener("click", function (e) {
            // Supprime tout autre menu déjà ouvert
            document.querySelectorAll(".status-options").forEach(el => el.remove());

            const currentStatus = cell.textContent.trim();

            const optionsBox = document.createElement("div");
            optionsBox.classList.add("status-options");

            Object.keys(statusColors).forEach(status => {
                const button = document.createElement("button");
                button.textContent = status;
                button.classList.add("status-btn", statusColors[status]);

                button.addEventListener("click", () => {
                    cell.textContent = status;
                    cell.className = `status ${statusColors[status]}`;
                    optionsBox.remove();
                });

                optionsBox.appendChild(button);
            });

            // Positionne le menu sous la cellule
            cell.style.position = "relative";
            cell.appendChild(optionsBox);

            e.stopPropagation();
        });
    });

    // Ferme le menu si clic en dehors
    document.addEventListener("click", function () {
        document.querySelectorAll(".status-options").forEach(el => el.remove());
    });
});
