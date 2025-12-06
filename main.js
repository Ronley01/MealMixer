//
// Expand / collapse meal steps
//
document.querySelectorAll(".toggle-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        const steps = btn.nextElementSibling;        // .meal-steps
        const actions = steps.nextElementSibling;    // .meal-actions

        steps.classList.toggle("open");

        if (steps.classList.contains("open")) {
            btn.textContent = "Hide Steps";
            if (actions) actions.style.display = "flex";
        } else {
            btn.textContent = "Show Steps";
            if (actions) actions.style.display = "none";
        }
    });
});


//
// Save Meal (AJAX with duplicate prevention)
//
function saveMeal(mealId) {

    const formData = new URLSearchParams();
    formData.append("meal_id", mealId);

    fetch("save_meal.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString()
    })
    .then(res => res.text())
    .then(response => {

        // find the button that triggered save
        const btn = document.querySelector(
            `.save-btn[data-meal-id="${mealId}"]`
        );

        if (!btn) return;

        if (response === "NOT_LOGGED_IN") {
            openModal();
        }

        else if (response === "ALREADY_SAVED") {
            btn.textContent = "Already Saved";
            btn.style.backgroundColor = "#999";
            btn.style.cursor = "not-allowed";
        }

        else if (response === "SAVED") {
            btn.textContent = "Saved!";
            btn.style.backgroundColor = "#4CAF50";
            btn.style.color = "white";
        }

        else {
            btn.textContent = "Error";
            btn.style.backgroundColor = "red";
            btn.style.color = "white";
        }
    })
    .catch(() => {
        alert("Network error.");
    });
}


//
// Copy ingredients to clipboard
//
function copyIngredients(text) {
    navigator.clipboard.writeText(text)
        .then(() => alert("Ingredients copied!"))
        .catch(() => alert("Could not copy ingredients."));
}


//
// Modal controls
//
function openModal() {
    const modal = document.getElementById("loginModal");
    if (modal) modal.style.display = "flex";
}

function closeModal() {
    const modal = document.getElementById("loginModal");
    if (modal) modal.style.display = "none";
}
