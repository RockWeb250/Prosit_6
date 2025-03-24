document.addEventListener("DOMContentLoaded", function () {
    const statusLabels = {
        Accepted: "Acceptée",
        Pending: "En Attente",
        Rejected: "Refusée"
    };

    const statusColors = {
        Accepted: "accepted",
        Pending: "pending",
        Rejected: "refused"
    };

    document.querySelectorAll("td.status").forEach(cell => {
        cell.addEventListener("click", function (e) {
            document.querySelectorAll(".status-options").forEach(el => el.remove());

            const optionsBox = document.createElement("div");
            optionsBox.classList.add("status-options");

            Object.keys(statusLabels).forEach(statusKey => {
                const button = document.createElement("button");
                button.textContent = statusLabels[statusKey];
                button.classList.add("status-btn", statusColors[statusKey]);

                button.addEventListener("click", () => {
                    cell.textContent = statusLabels[statusKey];
                    cell.className = `status ${statusColors[statusKey]}`;
                    optionsBox.remove();
                });

                optionsBox.appendChild(button);
            });

            cell.style.position = "relative";
            cell.appendChild(optionsBox);

            e.stopPropagation();
        });
    });

    document.addEventListener("click", () => {
        document.querySelectorAll(".status-options").forEach(el => el.remove());
    });
});
