document.addEventListener("DOMContentLoaded", function () {
    const getCatBtn = document.getElementById("getCat");
    const postCatBtn = document.getElementById("postCat");
    const putCatBtn = document.getElementById("putCat");
    const deleteCatBtn = document.getElementById("deleteCat");
    const catImage = document.getElementById("catImage");
    const catFact = document.getElementById("catFact");
    const messageBox = document.getElementById("messageBox");

    function showMessage(text, type) {
        messageBox.textContent = text;
        messageBox.className = "message " + type;
        messageBox.style.display = "block";
        setTimeout(() => messageBox.style.display = "none", 3000);
    }

    if (getCatBtn) {
        getCatBtn.addEventListener("click", function () {
            fetch("api/get_cat.php")
                .then(response => response.json())
                .then(data => {
                    catImage.src = data.image;
                    catFact.textContent = data.fact;
                })
                .catch(error => console.error("Error fetching cat:", error));
        });
    }

    function handleAction(url, successMessage) {
        fetch(url, { method: "POST" })
            .then(response => response.json())
            .then(() => showMessage(successMessage, "success"))
            .catch(() => showMessage("Action failed", "error"));
    }

    if (postCatBtn) postCatBtn.addEventListener("click", () => handleAction("api/post_cat.php", "Cat fact added!"));
    if (putCatBtn) putCatBtn.addEventListener("click", () => handleAction("api/put_cat.php", "Cat fact updated!"));
    if (deleteCatBtn) deleteCatBtn.addEventListener("click", () => handleAction("api/delete_cat.php", "Cat fact deleted!"));
});

