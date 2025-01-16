document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const addItemBtn = document.getElementById("addItemBtn");
    const closeBtn = document.querySelector(".close-btn");
    const uploadForm = document.getElementById("uploadForm");
    const portfolioItems = document.getElementById("portfolio-items");

    // Show Modal
    addItemBtn.addEventListener("click", () => {
        modal.style.display = "flex";
    });

    // Close Modal
    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Handle Form Submission
    uploadForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const title = document.getElementById("title").value;
        const description = document.getElementById("description").value;
        const image = document.getElementById("image").files[0];

        if (title && description && image) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Create a new portfolio item
                const newItem = document.createElement("div");
                newItem.className = "grid-item";
                newItem.innerHTML = `
                    <img src="${event.target.result}" alt="${title}">
                    <h3>${title}</h3>
                    <p>${description}</p>
                `;

                // Append to portfolio
                portfolioItems.appendChild(newItem);
            };
            reader.readAsDataURL(image);

            // Clear Form and Close Modal
            uploadForm.reset();
            modal.style.display = "none";
        }
    });

    // Close modal if clicking outside
    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});